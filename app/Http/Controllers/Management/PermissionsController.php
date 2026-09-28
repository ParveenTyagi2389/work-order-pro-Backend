<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\{Permission,Role };

use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PermissionsController extends Controller implements HasMiddleware
{


    public static function middleware(): array
    {
        return [
            
            // Apply specific middleware to index method
            new Middleware('permission:view permissions', only: ['index']),
            
            // Apply permission middleware to specific methods
            new Middleware('permission:create permissions', only: ['store']),
            new Middleware('permission:edit permissions', only: ['edit', 'update']),
            new Middleware('permission:delete permissions', only: ['destroy']),
        ];
    }
    // this function shows the list of permissions
   public function index()
    {
        $permissions = Permission::orderBy('name')->paginate(10);
        return view('permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new permission
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created permission
     */
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:permissions,name',
            'guard_name' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create the permission
        Permission::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name ?? 'web'
        ]);

        return redirect()->route('permissions.index')
            ->with('success', 'Permission created successfully!');
    }

    /**
     * Show the form for editing the specified permission
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified permission
     */
    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:permissions,name,' . $id,
            'guard_name' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $permission->update([
            'name' => $request->name,
            'guard_name' => $request->guard_name ?? 'web'
        ]);

        return redirect()->route('permissions.index')
            ->with('success', 'Permission updated successfully!');
    }

    /**
     * Remove the specified permission
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        
        // Check if permission is assigned to any role
        if ($permission->roles()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Cannot delete permission as it is assigned to roles.');
        }

        $permission->delete();

        return redirect()->route('permissions.index')
            ->with('success', 'Permission deleted successfully!');
    }
    


}
