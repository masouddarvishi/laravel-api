<?php

namespace Hooraweb\LaravelApi\Controllers;

use App\Http\Controllers\Controller;
use Hooraweb\LaravelApi\Http\Requests\User\UserIndexRequest;
use Hooraweb\LaravelApi\Http\Requests\User\UserShowRequest;
use Hooraweb\LaravelApi\Http\Requests\User\UserStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;
use User;

class UserController extends Controller
{
    public function index(UserIndexRequest $request)
    {
        $query = QueryBuilder::for(User::class)
            ->allowedFilters(['name', 'mobile', 'id'])
            ->allowedSorts(['name', 'mobile', 'id'])
            ->allowedIncludes(['roles']);

        $result = request('per_page', false) ? $query->paginate(request('per_page')) : $query->get();


        return User::collection($result);
    }

    public function show(UserShowRequest $request)
    {
        return User::resource($request->user);

    }

    public function store(UserStoreRequest $request)
    {
        $request->user->fill($request->only(['name', 'mobile']));

        // only admins with manage-users permission can change user role or delete them.
        if (Auth::user()->can('manage-users')) {
            $request->user->fill($request->only(['roles', 'deleted_at']));
        }

        $request->user->assignRole($request->role);
        $request->user->save();

        return User::resource($request->user);
    }
}
