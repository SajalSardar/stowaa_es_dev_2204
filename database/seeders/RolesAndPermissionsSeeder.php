<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $user = User::create([
            'name' => "App super admin",
            'email' => "super@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('123'), // password
            'remember_token' => Str::random(10),
        ]);


        $role = Role::create(['name' => 'super-admin']);
        
        Role::create(['name' => 'user']);

        $user->assignRole('super-admin');

        // create permissions
        $arrayOfPermissionNames = [ 
            'add role', 
            'edit role', 
            'delete role', 
            'see role'
        ];

        $permissions = collect($arrayOfPermissionNames)->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'web'];
        });
    
        Permission::insert($permissions->toArray());

    
    }
}
