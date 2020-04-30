<?php

namespace Hooraweb\LaravelApi\Http\Controllers;

use App\Http\Controllers\Controller;
use Hooraweb\LaravelApi\Http\Requests\Role\RoleIndexRequest;
use Hooraweb\LaravelApi\Http\Requests\Role\RoleShowRequest;
use Hooraweb\LaravelApi\Http\Requests\Role\RoleStoreRequest;
use Illuminate\Support\Facades\DB;
use Role;

class RoleController extends Controller {

    /**
     * show roles
     *
     * @param RoleIndexRequest $request
     *
     * @return
     */
    public function index(RoleIndexRequest $request)
    {
        return $this->resourceCollection(RoleCollection::class, Role::class,
            ['id', 'name'], ['id', 'name'], [], 'id');
    }

    /**
     * find role by id
     *
     * @param RoleShowRequest $request
     *
     * @return
     */
    public function show(RoleShowRequest $request)
    {
        return Role::resource($request->role);
    }

    /**
     * store new role
     *
     * @param RoleStoreRequest $request
     *
     * @return RoleResource|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(RoleStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            // store role
            $role = $request->role->fill(['name' => $request->get('name'), 'guard_name' => 'web']);
            $role->save();
            // sync role's permissions
            // if role id is 1(admin) all permissions will be assing to it.
            $role->permissions()->sync($role->id == 1 ? Permission::select('id')->get()->pluck('id')->toArray() : $request->get('permissions'));
            DB::commit();
            // enumClear();
            //broadcast(new \App\Events\PublicMessage(enum()));
            return new RoleResource($role->load('permissions'));
            return Role::resource($role->load('permissions'));
            
        }catch (\Exception $e){
            DB::rollBack();
            return response(['message' => 'اطلاعات ذخیره نشد!']);
        }

    }

}