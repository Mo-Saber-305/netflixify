<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create_users')->only(['create']);
        $this->middleware('permission:read_users')->only(['index']);
        $this->middleware('permission:update_users')->only(['edit']);
        $this->middleware('permission:delete_users')->only(['destroy']);
    }//end of construct

    public function index(Request $request)
    {
        $users = User::whereRoleNot('super_admin')->whenRole($request->role)->with('roles')->get();
        $roles = Role::whereRoleNot('super_admin')->get();
        return view('dashboard.pages.users.index', compact('users', 'roles'));
    }//end of index

    public function getUserByRole(Request $request)
    {
        $users = User::WhereRoleNot('super_admin')->with('roles')->whenRole($request->role)->get();
        return response()->json([
            'success' => true,
            'msg' => 'data retrieved successfully',
            'data' => $users,
        ]);
    }//end of user with role

    public function create()
    {
        $roles = Role::whereRoleNot(['super_admin', 'admin'])->get();
        return view('dashboard.pages.users.create', compact('roles'));
    }//end of create

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:users,email'],
            'password' => ['required', 'confirmed'],
            'role' => ['required', 'numeric'],
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password'])
        ]);

        $user->attachRoles(['admin', $request['role']]);

        alert()->success('Users Added Successfully');

        return redirect()->route('dashboard.users.index');
    }//end of store

    public function edit(User $user)
    {
        $roles = Role::whereRoleNot(['super_admin', 'admin'])->get();
        return view('dashboard.pages.users.edit', compact('user', 'roles'));
    }//end of edit

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:users,email, ' . $user->id],
            'role' => ['required', 'numeric'],
        ]);

        $user->update([
            'name' => $request['name'],
            'email' => $request['email'],
        ]);

        $user->syncRoles(['admin', $request['role']]);

        alert()->success('Users Updated Successfully');

        return redirect()->route('dashboard.users.index');
    }//end of update


    public function destroy(Request $request)
    {
        $user = User::findOrFail($request['id']);

        $user->delete();

        alert()->error('Users Deleted Successfully');

        return redirect()->route('dashboard.users.index');
    }//end of destroy

}// end of controller
