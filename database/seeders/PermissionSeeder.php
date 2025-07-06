<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // List of your models
        $models = [
            'Employee',
            'IdentityCardTemplate',
            'IdentityCardDetail',
            'IdentityCardTemplateDetail',
            'JobPosition',
            'JobTitleCategory',
            'MaritalStatus',
            'Organization',
            'OrganizationUnit',
            'Region',
            'Salary',
            'User',
            'Woreda',
            'Zone'
        ];

        // CRUD actions for each model
        $actions = ['create', 'read', 'update', 'delete'];

        // Generate permissions
        foreach ($models as $model) {
            foreach ($actions as $action) {
                Permission::firstOrCreate([
                    'name' => "$action $model",
                    'guard_name' => 'web'
                ]);
            }
        }

        $adminRole = Role::firstOrCreate([
            'name' => 'Super Admin',
            'guard_name' => 'web'
        ]);

        $adminRole->syncPermissions(Permission::all());


        // Optional Employee role
        $employeeRole = Role::firstOrCreate([
            'name' => 'Employee',
            'guard_name' => 'web'
        ]);

        $employeePermissions = Permission::whereIn('name', [
            'read IdentityCardDetail',
            'read Organization',
        ])->get();

        $employeeRole->syncPermissions($employeePermissions);
    }
}