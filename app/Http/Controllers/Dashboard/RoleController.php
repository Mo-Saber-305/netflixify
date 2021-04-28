<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create_roles')->only(['create', 'store']);
        $this->middleware('permission:read_roles')->only(['index']);
        $this->middleware('permission:update_roles')->only(['edit', 'update']);
        $this->middleware('permission:delete_roles')->only(['destroy']);
    }//end of construct

    public function index()
    {
        $roles = Role::whereRoleNot(['super_admin'])
            ->with('permissions')->withCount('users')->get();
        return view('dashboard.pages.roles.index', compact('roles'));
    }//end of index

    public function create()
    {
        return view('dashboard.pages.roles.create');
    }//end of create

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:roles,name'],
            'permissions' => ['required', 'array', 'min: 1'],
        ]);

        $role = Role::create([
            'name' => Str::lower(str_replace(' ', '_', $request['name'])),
            'display_name' => $request['name'],
            'description' => $request['name']
        ]);

        $role->attachPermissions($request['permissions']);

        alert()->success('Roles Added Successfully');

        return redirect()->route('dashboard.roles.index');
    }//end of store

    public function edit(Role $role)
    {
        return view('dashboard.pages.roles.edit', compact('role'));
    }//end of edit

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => ['required', 'unique:roles,name, ' . $role->id],
            'permissions' => ['required', 'array', 'min: 1'],
        ]);

        $role->update([
            'name' => Str::lower(str_replace(' ', '_', $request['name'])),
            'display_name' => Str::ucfirst($request['name']),
            'description' => Str::ucfirst($request['name'])
        ]);

        $role->syncPermissions($request['permissions']);

        alert()->success('Roles Updated Successfully');

        return redirect()->route('dashboard.roles.index');
    }//end of update


    public function destroy(Request $request)
    {
        $role = Role::findOrFail($request['id']);

        $role->delete();

        alert()->error('Roles Deleted Successfully');

        return redirect()->route('dashboard.roles.index');
    }//end of destroy
}
