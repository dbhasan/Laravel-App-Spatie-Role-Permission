<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Exception;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:Role.view'], ['only' => ['indexrole', 'createrole', 'storerole', 'editrole', 'updaterole']]);
    }

    public function indexrole()
    {
        $roles = Role::all();
        return view('role.index', compact('roles'));
    }
    public function createrole()
    {
        return view('role.create');
    }

    public function storerole(Request $request)
    {
        try {
            $this->validate($request, [
                'name'          => 'required|unique:roles,name',
            ]);

            // Save role with guard_name = web
            $role = Role::create([
                'name'       => $request->input('name'),
                'guard_name' => 'web'
            ]);

            return redirect()->route('role.index')->with('success', 'Role created successfully');
        } catch (Exception $e) {
            return redirect()->route('role.index')->with('error', 'An error occurred. Please try again.');
        }
    }

    public function editrole($id)
    {
        $role = Role::findOrFail($id);

        // Get permissions grouped by module
        $permissions = Permission::orderBy('module')
            ->get()
            ->groupBy('module');

        // Get permission IDs already assigned
        $rolePermissions = DB::table("role_has_permissions")
            ->where("role_id", $id)
            ->pluck('permission_id')
            ->toArray();

        return view('role.edit', compact('role', 'permissions', 'rolePermissions'));
    }


    public function updaterole(Request $request, $id)
    {
        $this->validate($request, [
            'permission' => 'required',
        ]);
        try {
            $role = Role::find($id);
            $role->save();

            $role->syncPermissions($request->input('permission'));

            return redirect()->route('role.index')->with('success', 'Role updated successfully');
        } catch (Exception $e) {
            return redirect()->route('role.index')->with('error', 'An error occurred. Please try again.');
        }
    }
}
