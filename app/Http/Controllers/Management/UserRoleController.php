<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\{Permission, Role};
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    /**
     * Display users with their roles and permissions
     */
    public function index()
    {
        $users = User::with('roles', 'permissions')->paginate(10);
        $roles = Role::orderBy('name')->get();
        $permissions = Permission::orderBy('name')->get();
        
        return view('user-roles.index', compact('users', 'roles', 'permissions'));
    }

    /**
     * Show form to assign roles to a user
     */
    public function assignRoles($userId)
    {
        $user = User::findOrFail($userId);
        $roles = Role::orderBy('name')->get();
        $userRoles = $user->roles->pluck('id')->toArray();
        
        return view('user-roles.assign-roles', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Assign roles to a user
     */
    public function storeRoles(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        $validator = Validator::make($request->all(), [
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Sync roles (convert IDs to role names for Spatie)
        if ($request->has('roles') && !empty($request->roles)) {
            $roleNames = Role::whereIn('id', $request->roles)
                ->pluck('name')
                ->toArray();
            $user->syncRoles($roleNames);
        } else {
            $user->syncRoles([]);
        }

        return redirect()->route('user-roles.index')
            ->with('success', 'Roles assigned to "' . $user->name . '" successfully!');
    }

    /**
     * Show form to assign permissions to a user
     */
    public function assignPermissions($userId)
    {
        $user = User::findOrFail($userId);
        $permissions = Permission::orderBy('name')->get();
        $userPermissions = $user->permissions->pluck('id')->toArray();
        
        return view('user-roles.assign-permissions', compact('user', 'permissions', 'userPermissions'));
    }

    /**
     * Assign permissions to a user
     */
    public function storePermissions(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        $validator = Validator::make($request->all(), [
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Sync permissions (convert IDs to permission names for Spatie)
        if ($request->has('permissions') && !empty($request->permissions)) {
            $permissionNames = Permission::whereIn('id', $request->permissions)
                ->pluck('name')
                ->toArray();
            $user->syncPermissions($permissionNames);
        } else {
            $user->syncPermissions([]);
        }

        return redirect()->route('user-roles.index')
            ->with('success', 'Permissions assigned to "' . $user->name . '" successfully!');
    }

    /**
     * Remove a specific role from user
     */
    public function removeRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = User::findOrFail($request->user_id);
        $role = Role::findOrFail($request->role_id);
        
        $user->removeRole($role->name);

        return response()->json([
            'success' => true,
            'message' => 'Role removed successfully!'
        ]);
    }

    /**
     * Remove a specific permission from user
     */
    public function removePermission(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'permission_id' => 'required|exists:permissions,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = User::findOrFail($request->user_id);
        $permission = Permission::findOrFail($request->permission_id);
        
        $user->revokePermissionTo($permission->name);

        return response()->json([
            'success' => true,
            'message' => 'Permission removed successfully!'
        ]);
    }

    /**
     * Get user's roles and permissions (AJAX)
     */
    public function getUserPermissions($userId)
    {
        $user = User::with('roles', 'permissions')->findOrFail($userId);
        
        return response()->json([
            'user' => $user,
            'roles' => $user->roles,
            'permissions' => $user->permissions,
            'all_permissions' => $user->getAllPermissions()
        ]);
    }

    /**
     * Bulk assign roles to multiple users
     */
    public function bulkAssignRoles(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
            'role_id' => 'required|exists:roles,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $role = Role::findOrFail($request->role_id);
        $users = User::whereIn('id', $request->user_ids)->get();

        foreach ($users as $user) {
            $user->assignRole($role->name);
        }

        return redirect()->back()
            ->with('success', 'Role assigned to ' . $users->count() . ' users successfully!');
    }
}
