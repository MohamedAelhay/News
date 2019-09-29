<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\roles\RoleStoreRequest;
use App\Http\Requests\roles\RoleUpdateRequest;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct()
    {
        $this->authorizeResource(Role::class, 'role');
    }

    public function index(Request $request)
    {
//        dd(DataTables::eloquent(Role::query())
//            ->addColumn('Actions', function ($role){
//                return view('roles.actions', compact('role'));
//            })
//            ->toJson());
        if($request->ajax()){
            return DataTables::eloquent(Role::query())
                ->addColumn('actions', function ($role){
                    return view('roles.actions', compact('role'));
                })
                ->toJson();
        }

        return view('roles.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('roles.create', [
            'permissions' => Permission::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\roles\RoleStoreRequest $request
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(RoleStoreRequest $request)
    {
        Role::create($request->only(['name', 'description']))->syncPermissions($request->permissions);
        return redirect()->route('roles.index')->with([
            'success' => 'Role "'.$request->name.'" has been added.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Role  $role
     * @return Response
     */
    public function show(Role $role)
    {
        return view('roles.show', [
            'role' => $role
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Role  $role
     * @return Response
     */
    public function edit(Role $role)
    {
        return view('roles.edit', [
            'role' => $role,
            'allPermissions' => Permission::all(),
            'rolePermissions'=> $role->getPermissionNames()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleUpdateRequest $request
     * @param Role Object $role
     * @return Response
     */
    public function update(RoleUpdateRequest $request, Role $role)
    {
        $role->update($request->only(['name', 'description']));
        $role->syncPermissions($request->permissions);
        return redirect()->route('roles.index')->with([
            'success' => 'Role "'.$request->name.'" has been Updated.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role Object $role
     * @return Response
     * @throws  \Exception
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with([
            'success' => 'Role "'.$role->name.'" has been Deleted.'
        ]);
    }
}
