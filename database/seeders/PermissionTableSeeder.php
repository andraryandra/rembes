<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            'category-tahun-list',
            'category-tahun-create',
            'category-tahun-edit',
            'category-tahun-delete',

            'rembes-list',
            'rembes-create',
            'rembes-edit',
            'rembes-delete',

            'rembes-item-list',
            'rembes-item-create',
            'rembes-item-edit',
            'rembes-item-delete',

            'submission-approved-list',
            'submission-approved-create',
            'submission-approved-edit',
            'submission-approved-delete',

            'submission-artikel-list',

            'submission-success-list',
            'submission-success-create',
            'submission-success-edit',
            'submission-success-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
