<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    public function indexRole(){
        $roles = Role::whereNotIn('name', ['super-admin'])->orderBy('id', 'desc')->get();
        return view('backend.permission.index', compact('roles'));
    }


    public function createRole(){
        $permissions = Permission::all();
        return view('backend.permission.create', compact('permissions'));
    }


    public function insertRole(Request $request){
        $request->validate([
            'name' => 'required',
            'permission' => 'required'
        ]);

        $roleId = Role::create([
            'name' => $request->name,
        ]);
        $roleId->givePermissionTo($request->permission);
        return redirect(route('backend.role.index'))->with('success', "Role Insert Successfull!");
    }

    //insert permission 
    public function insertPermission(Request $request){

        Permission::create([
            'name' => $request->name,
        ]);
        return back();
    }


    public function editRole($id){
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('backend.permission.edit', compact('permissions','role'));
    }
    public function updateRole(Request $request, $id){
        $role = Role::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'permission' => 'required'
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        $role->syncPermissions($request->permission);

        return redirect(route('backend.role.index'))->with('success', "Role Update Successfull!");
    }

}
