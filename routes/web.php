<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Backend\RolePermissionController;



Auth::routes();

// frontend routs
Route::get('/', [FrontendController::class, 'index'])->name('frontend.home');
Route::get('/user/login-signup', [FrontendController::class, 'userLogin'])->name('frontend.user.login');


//backend routs
Route::prefix('dashboard')->name('backend.')->middleware('auth')->group(function(){
    Route::get('/', [DashboardController::class, 'index'])->name('home');

    //role and permission route
    Route::controller(RolePermissionController::class)->group(function(){

        Route::get('/role', 'indexRole')->name('role.index')->middleware(['role_or_permission:super-admin|see role']);

        Route::get('/role/create', 'createRole')->name('role.create')->middleware(['role_or_permission:super-admin|add role']);
        Route::post('/role/create', 'insertRole')->name('role.insert')->middleware(['role_or_permission:super-admin|add role']);
        Route::get('/role/edit/{id}', 'editRole')->name('role.edit')->middleware(['role_or_permission:super-admin|edit role']);
        Route::put('/role/update/{id}', 'updateRole')->name('role.update')->middleware(['role_or_permission:super-admin|edit role']);

        //add permission route
        Route::post('/permission/insert', 'insertPermission')->name('permission.insert');
    });
    
});





// test route 

// Route::get('/test', function(){
//     $role = Role::find(1);
//     $user = User::find(1);
//     $user->assignRole($role);
//     return $role;
// });






