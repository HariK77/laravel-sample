<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::latest()->paginate(10);
        return view('dashboard.access-management.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('dashboard.access-management.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate name and permissions field
        request()->validate(
            [
                'name' => 'required|unique:roles',
                'permissions' => 'required',
            ],
            [
                'permissions.required' => 'Please select at least one permission for the Role'
            ]
        );

        $role = Role::create(['name' => $request->name]);

        //Looping thru selected permissions
        foreach ($request->permissions as $permission_id) {
            $permission = Permission::where('id', $permission_id)->firstOrFail();
            //Fetch the newly created role and assign permission
            $role = Role::where('name', $request->name)->first();

            $role->givePermissionTo($permission);
        }

        return redirect()->route('roles.index')->with('success', 'Role ' . $role->name . ' added successfully !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return redirect()->route('roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('dashboard.access-management.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        request()->validate(
            [
                'name' => 'required|unique:roles,name,' . $role->id,
                'permissions' => 'required',
            ],
            [
                'permissions.required' => 'Please select at least one permission for the Role'
            ]
        );

        $role->update(['name' => $request->name]);

        $all_permissions = Permission::all();

        foreach ($all_permissions as $permission) {
            $role->revokePermissionTo($permission);
        }

        foreach ($request->permissions as $permission_id) {

            $permission = Permission::where('id', '=', $permission_id)->firstOrFail(); //Get corresponding form //permission in db

            $role->givePermissionTo($permission);  //Assign permission to role
        }

        return redirect()->route('roles.index')->with('success', 'Role '. $role->name.' updated successfully !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->back()->with('success', 'Role "'.$role->name.'" deleted successfully !!');
    }
}
