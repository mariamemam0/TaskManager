<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //create permissions
        $permissions = [
            'create project',
            'delete project',
            'update project',
            'create task',
            'delete task',
            'update task',
            'assign task',
            'manage users',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'api']);
        }
        //create roles and assign permissions
        $member = Role::create(['name' => 'member','guard_name' => 'api']);
        $member->givePermissionTo([
            Permission::where('guard_name', 'api')
                ->whereIn('name', [
                    'create project',
                    'update project',
                    'create task',
                    'update task',
                    'assign task',
                ])->get()
        ]);

        $admin = Role::create(['name' => 'admin' , 'guard_name' => 'api']);
        $admin->givePermissionTo(Permission::all());
    }
}
