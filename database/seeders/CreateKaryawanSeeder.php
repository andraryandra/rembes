<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateKaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Diong',
            'email' => 'diong@gmail.com',
            'password' => bcrypt('password'),
            'phone' => '081234567890',
            'address' => 'Jl. Raya Kebayoran Lama No. 12, Jakarta Selatan',
        ]);

        // Menetapkan izin yang diinginkan
        $permissions = [
            'rembes-list',
            'rembes-create',
            'rembes-edit',
            'rembes-delete',

            'rembes-item-list',
            'rembes-item-create',
            'rembes-item-edit',
            'rembes-item-delete',
        ];

        // Menetapkan peran 'User' jika belum ada
        $role = Role::firstOrCreate(['name' => 'User']);

        // Menetapkan izin ke peran 'User'
        $role->syncPermissions($permissions);

        // Menetapkan peran 'User' ke pengguna yang baru dibuat
        $user->assignRole([$role->id]);
    }
}
