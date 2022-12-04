<?php

use App\Http\Controllers\Backend\CategoryController;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Backend\RolePermissionController;



Auth::routes(['verify' => true]);

// frontend routs
Route::get('/', [FrontendController::class, 'index'])->name('frontend.home');
Route::get('/user/login-signup', [FrontendController::class, 'userLogin'])->name('frontend.user.login');


//backend routs
Route::prefix('dashboard')->name('backend.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home');

    Route::controller(CategoryController::class)->prefix('product/category')->name('product.')->group(function () {
        Route::get('/',  'index')->name('category.index');
        Route::post('/',  'store')->name('category.store');
        Route::get('/edit/{category}', 'edit')->name('category.edit');
        Route::put('/update/{category}', 'update')->name('category.update');
        Route::delete('/delete/{category}', 'destroy')->name('category.delete');
        Route::get('/restore/{id}', 'restore')->name('category.restore');
        Route::delete('/permanate/delete/{id}', 'permanateDestroy')->name('category.permanate.destroy');
    });

    Route::controller(ProductController::class)->prefix('product')->name('product.')->group(function () {
        Route::get('/',  'index')->name('index');
        Route::get('/create',  'create')->name('create');
    });

    //role and permission route
    Route::controller(RolePermissionController::class)->group(function () {
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