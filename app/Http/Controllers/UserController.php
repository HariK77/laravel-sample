<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('type', '!=', 'admin')->paginate(10);
        return view('dashboard.access-management.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('dashboard.access-management.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request_data = request()->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create($request_data);

        //Checking if a role was selected
        if (isset($request->roles)) {

            foreach ($request->roles as $roleId) {

                $role = Role::where('id', '=', $roleId)->firstOrFail();

                $user->assignRole($role); //Assigning role to user
            }
        }

        return redirect()->route('users.index')->with('success', 'User "' . $user->name . '" added Successfully !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all(); //Get all roles

        return view('dashboard.access-management.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $request_data = request()->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:100|unique:users,email,'.$user->id,
            // 'password' => 'sometimes|required|string|min:8|confirmed',
        ]);

        if ($request->filled('password')) {

            $request->validate([
                'password' => 'required|string|min:8|confirmed',
            ]);

            $request_data['password'] = $request->password;
        }

        $user->update($request_data);

        //Checking if a role was selected
        if (isset($request->roles)) {

            $user->roles()->sync($request->roles);  //If one or more role is selected associate user to roles

        } else {

            $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }

        return redirect()->route('users.index')->with('success', $user->name.' and his roles were successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'User '.$user->name.' has been deleted.');
    }
}
