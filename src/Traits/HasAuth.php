<?php


namespace Hooraweb\LaravelApi\Traits;


use User;
//use App\Notifications\VerificationCode;
//use App\Enums\System;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Laravel\Passport\PersonalAccessTokenResult;

trait HasAuth
{
    /**
     * auth config in
     *
     * @var \Illuminate\Config\Repository|mixed
     */
    private $authConfig;

    public function __construct()
    {
        $this->authConfig = config('auth');
    }

    /**
     * guess user identifier type for login, register and password reset. (mobile, email)
     *
     * @param string $for
     * @param null $key
     * @return mix
     */
    protected function guessIdentifier($key = null, $for = 'login')
    {

        foreach ($this->authConfig[$for]['identifiers'] as $k => $value) {
            if (preg_match($value['pattern'], request('identifier'))) {
                return $key == null ? $value : $value[$key];
            }
        }

        return null;
    }

    /**
     *
     * @return bool
     */
    public function isPasswordTemporary()
    {
        return $this->authConfig['password']['name'] == System::PASSWORD_TYPE_TEMPORARY;
    }

    /**
     * check if user password is match and if it is return user info or null.
     *
     * @return User $user | null
     */
    protected function checkPassword()
    {
        $identifier = $this->guessIdentifier();

        if ($identifier == null) {
            return null;
        }

        // if login is via temporary password
        if ($this->authConfig['password']['name'] === System::PASSWORD_TYPE_TEMPORARY) {
            if (Cache::get(request('identifier'), bcrypt(request('password'))) == request('password')) {
                // clear password cache
                Cache::forget(request('identifier'));
                return User::where($identifier['name'], request('identifier'))->first();
            }
            return null;
        }

        // login is via permanently password
        $user = User::where($identifier['name'], request('identifier'))->first();

        return empty($user) ? null : Hash::check(request('password'), $user->password) ? $user : null;
    }

    /**
     * send temporary password to user.
     *
     */
    protected function sendPassword()
    {
        $user = User::where($this->guessIdentifier('name'), request('identifier'))->first();

        $identifier = $this->guessIdentifier();

        $password = rand(10000, 99999);

        Cache::put(request('identifier'), $password, 3 * 60);

        Notification::sendNow($user, new VerificationCode($password, $identifier['via']));
    }

    /**
     * create token for authenticated user.
     *
     * @param User $user
     *
     * @return PersonalAccessTokenResult
     */
    protected function createToken($user)
    {
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->expires_at = request('remember_me', false) == true ?
            Carbon::now()->addYears(5) : Carbon::now()->addHours(3);
        $token->save();

        return $tokenResult;
    }

    /**
     * create or update password reset.
     *
     * @return bool
     */
    protected function createPasswordReset()
    {
        $token = rand(111111, 999999);

        $created = DB::table('password_resets')
            ->updateOrInsert(['identifier' => request('identifier')], [
                'identifier' => request('identifier'),
                'token' => $token,
                'created_at' => now()
            ]);

        if ($created) {
            $identifier = $this->guessIdentifier();
            Notification::sendNow(
                User::where($identifier['name'], request('identifier'))->first(),
                new VerificationCode($token, $identifier['via']));
        }

        return $created;
    }


    /**
     * delete user's record in password_resets table and and update user password
     *
     */
    protected function resetPassword()
    {
        $passwordReset = DB::table('password_resets')
            ->where('identifier', request('identifier'))
            ->where('token', request('token'))
            ->first();

        if (empty($passwordReset)) {
            return false;
        }

        // update user password
        User::where($this->guessIdentifier('name'), request('identifier'))
            ->update(['password' => bcrypt(request('password')), 'remember_token' => Str::random(50)]);

        // delete password rest request form database
        DB::table('password_resets')
            ->where('identifier', request('identifier'))
            ->where('token', request('token'))
            ->delete();

        return true;
    }

    protected function createRegisterVerification()
    {
        $identifier = $this->guessIdentifier();

        $password = rand(100000, 999999);

        Cache::put(request('identifier') . '_register', $password, 5 * 60);

        $user = new \stdClass();
        $user->{$identifier['name']} = request('identifier');

        Notification::sendNow($user, new VerificationCode($password, $identifier['via']));

    }

    protected function registerUser()
    {
        $identifier = $this->guessIdentifier();

        if (Cache::get(request('identifier') . '_register', bcrypt(request('token'))) == request('token')) {
            $user = new User();
            $user->{$identifier['name']} = request('identifier');
            $user->name = request('name');
            $user->family = request('family');

            if ($this->authConfig['password']['name'] == System::PASSWORD_TYPE_PERMANENTLY) {
                $user->password = bcrypt(request('password'));
            }
           $user->save();

            // clear token cache
            Cache::forget(request('identifier') . '_register');

            return true;
        }

        return false;
    }
}