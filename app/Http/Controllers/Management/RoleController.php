<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RoleController extends Controller implements HasMiddleware
{
    /**
     * Define middleware for this controller
     */
    public static function middleware(): array
    {
        return [
            
            // Apply specific middleware to index method
            new Middleware('permission:view roles', only: ['index']),
            
            // Apply permission middleware to specific methods
            new Middleware('permission:create roles', only: ['store']),
            new Middleware('permission:edit roles', only: ['edit', 'update']),
            new Middleware('permission:delete roles', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of roles
     */
    public function index()
    {
        $roles = Role::orderBy('name')->paginate(10);
        $permissions = Permission::orderBy('name')->get();
        return view('roles.index', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created role
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:roles,name',
            'guard_name' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name ?? 'web'
        ]);

        // Assign permissions if selected
        if ($request->has('permissions') && !empty($request->permissions)) {
            $permissionNames = Permission::whereIn('id', $request->permissions)
                ->pluck('name')
                ->toArray();
            $role->syncPermissions($permissionNames);
        }

        return redirect()->route('roles.index')
            ->with('success', 'Role "' . $request->name . '" created successfully!');
    }

    /**
     * Show the form for editing the specified role
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::orderBy('name')->get();
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        
        return view('roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified role
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
            'guard_name' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $role->update([
            'name' => $request->name,
            'guard_name' => $request->guard_name ?? 'web'
        ]);

        // Handle permissions sync
        if ($request->has('permissions')) {
            $permissions = $request->permissions;
            
            if (!empty($permissions)) {
                if (is_numeric($permissions[0])) {
                    // IDs
                    $permissionNames = Permission::whereIn('id', $permissions)
                        ->pluck('name')
                        ->toArray();
                    $role->syncPermissions($permissionNames);
                } else {
                    // Names
                    $role->syncPermissions($permissions);
                }
            } else {
                $role->syncPermissions([]);
            }
        } else {
            $role->syncPermissions([]);
        }

        return redirect()->route('roles.index')
            ->with('success', 'Role "' . $request->name . '" updated successfully!');
    }

    /**
     * Remove the specified role
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        
        // Prevent deleting admin role
        if ($role->name === 'admin' || $role->name === 'super-admin') {
            return redirect()->back()
                ->with('error', 'Cannot delete the ' . $role->name . ' role.');
        }

        // Check if role has users assigned
        if ($role->users()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Cannot delete "' . $role->name . '" as it has ' . $role->users()->count() . ' user(s) assigned.');
        }

        $roleName = $role->name;
        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Role "' . $roleName . '" deleted successfully!');
    }
}