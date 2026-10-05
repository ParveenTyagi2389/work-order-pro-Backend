<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Management\{PermissionsController, RoleController, UserRoleController};
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\WorkSiteController;
use App\Http\Controllers\Admin\{SiteController, CustomerTypeController};
use Spatie\LaravelPackageTools\Concerns\Package\HasViewComposers;


Route::redirect('/', '/login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('permissions/index', [PermissionsController::class, 'index'])->name('permissions.index');
    Route::get('permissions/create', [PermissionsController::class, 'create'])->name('permissions.create');
    Route::post('permissions', [PermissionsController::class, 'store'])->name('permissions.store');
    Route::get('permissions/{id}/edit', [PermissionsController::class, 'edit'])->name('permissions.edit');
    Route::put('permissions/{id}', [PermissionsController::class, 'update'])->name('permissions.update');
    Route::delete('permissions/{id}', [PermissionsController::class, 'destroy'])->name('permissions.destroy');

    Route::get('roles/index', [RoleController::class, 'index'])->name('roles.index');
    Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('roles/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');


    // User Role & Permission Assignment Routes
    Route::get('/user-roles', [UserRoleController::class, 'index'])->name('user-roles.index');
    
    // Assign roles to user
    Route::get('/user-roles/{userId}/assign-roles', [UserRoleController::class, 'assignRoles'])->name('user-roles.assign-roles');
    Route::post('/user-roles/{userId}/store-roles', [UserRoleController::class, 'storeRoles'])->name('user-roles.store-roles');
    
    // Assign permissions to user
    Route::get('/user-roles/{userId}/assign-permissions', [UserRoleController::class, 'assignPermissions'])->name('user-roles.assign-permissions');
    Route::post('/user-roles/{userId}/store-permissions', [UserRoleController::class, 'storePermissions'])->name('user-roles.store-permissions');
    
    // Remove role/permission from user (AJAX)
    Route::post('/user-roles/remove-role', [UserRoleController::class, 'removeRole'])->name('user-roles.remove-role');
    Route::post('/user-roles/remove-permission', [UserRoleController::class, 'removePermission'])->name('user-roles.remove-permission');
    
    // Get user permissions (AJAX)
    Route::get('/user-roles/{userId}/permissions', [UserRoleController::class, 'getUserPermissions'])->name('user-roles.get-permissions');
    
    // Bulk assign roles
    Route::post('/user-roles/bulk-assign', [UserRoleController::class, 'bulkAssignRoles'])->name('user-roles.bulk-assign');

    // Work Site Routes
    Route::get('/map', [WorkSiteController::class, 'index'])->name('map.index');
    Route::get('/add-site', [WorkSiteController::class, 'create']);
    Route::post('/add-site', [WorkSiteController::class, 'store'])->name('site.store');

    // Site Routes
    Route::resource('sites', SiteController::class);
    
    Route::resource('customer-types', CustomerTypeController::class);

});





require __DIR__.'/auth.php';

