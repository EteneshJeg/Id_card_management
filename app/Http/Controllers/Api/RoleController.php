<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        return Role::with('permissions')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles',
            'permissions' => 'array'
        ]);


        $permissions = Permission::whereIn('name', $request->permissions)->get();

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);



        if ($request->has('permissions')) {
            $role->syncPermissions($permissions);
        }


        return response()->json($role, 200);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name,' . $role->id,
            'permissions' => 'array'
        ]);

        $role->update(['name' => $request->name]);

        if ($request->has('permissions')) {
            // Make sure you're fetching Permission models
            $permissions = Permission::whereIn('name', $request->permissions)
                ->where('guard_name', $role->guard_name) // Match the guard!
                ->get();

            $role->syncPermissions($permissions);
        }

        return response()->json($role);
    }


    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json([
            'message' => 'Role deleted successfully'
        ], 200);
    }
}
