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
                    'name' => "$action $model"
                ]);
            }
        }

        // Create Super Admin role with all permissions
        $adminRole = Role::firstOrCreate(['name' => 'Super Admin']);
        $adminRole->syncPermissions(Permission::all());
    }
}