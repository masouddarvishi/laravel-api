<?php

namespace Hooraweb\LaravelApi\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Hooraweb\LaravelApi\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use User;
class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if ($request->password == '123456') {
            $user = User::where('mobile', $request->mobile)->first() ?? User::create(['mobile' => $request->mobile]);
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->expires_at = request('remember_me', false) == true ? Carbon::now()->addYears(5): Carbon::now()->addHours(3);
            $token->save();
            return ['token' => $tokenResult->accessToken];
        }else{
            return ['message' => 'رمز موقت برای شما ارسال گردید.'];
        }

    }

    /**
     * get authenticated user info
     *
     */
    public function authenticatedUser()
    {
        return User::resource(Auth::user()->load('roles'));
    }

    /**
     *
     */
    public function logout()
    {

    }

}
