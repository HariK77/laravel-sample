<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::latest()->paginate(10);
        return view('dashboard.access-management.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('dashboard.access-management.permissions.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:40|unique:permissions',
        ]);

        $permission = Permission::create(['name' => $request->name]);

        if (!empty($request->roles)) { //If one or more role is selected

            foreach ($request->roles as $role_id) {

                $role = Role::where('id', $role_id)->firstOrFail(); //Match input role to db record

                $permission = Permission::where('name', $request->name)->first(); //Match input //permission to db record

                $role->givePermissionTo($permission);
            }
        }

        return redirect()->route('permissions.index')->with('success', 'Permission "' . $permission->name . '" added successfully !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('permissions.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('dashboard.access-management.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $request_data = $this->validate($request, [
            'name' => 'required|max:40',
        ]);

        $permission->update($request_data);

        return redirect()->route('permissions.index')->with('success', 'Permission "' . $permission->name . '" updated successfully !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        //Make it impossible to delete this specific permission
        if ($permission->name == "Administration") {
            return redirect()->back()->with('error', 'Cannot delete this Permission!');
        }

        $permission->delete();

        return redirect()->back()->with('success', 'Permission "' . $permission->name . '" deleted successfully !!');
    }

}
