<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return response()->json($roles);
    }
    public function createPermission(Request $request)
    {
        $request->validate(['name' => 'required|string|unique:permissions,name']);
        $permission = Permission::create(['name' => $request->name]);
        return response()->json(['message' => 'Permission created', 'data' => $permission]);
    }

    public function createRole(Request $request)
    {
        $request->validate(['name' => 'required|string|unique:roles,name']);
        $role = Role::create(['name' => $request->name]);
        return response()->json(['message' => 'Role created', 'data' => $role]);
    }

    public function assignPermissions(Request $request,$role_id)
    {
        $role = Role::find($role_id);

        if(!$role) {
            return response()->json(['message'=> 'Role not found'], 404);
        }

        $permissions = $request->input('permissions');
        if(empty($permissions)) {
            return response()->json(['message'=> 'Permissions list cannot be empty'],400);
        }

        // Assign permissions to the role 
        $role->permissions()->sync($permissions);

        return response()->json(['message'=> 'Permissions assigned successfully']);
    }

    public function assignPermissionsToRole($roleId, Request $request)
    {
        $role = Role::findOrFail($roleId);
        $permissions = Permission::find($request->permissions);

        $role->permissions()->sync($permissions); // Use sync to attach permissions

        return response()->json(['message' => 'Permissions assigned to role successfully.']);
    }

    // Assign roles to a user
    public function assignRoleToUser($user_id, Request $request)
    {
        $user = User::findOrFail($user_id);
        $roles = Role::find($request->roles);

        $user->roles()->sync($roles); // Use sync to attach roles

        return response()->json(['message' => 'Roles assigned to user successfully.']);
    }
}
