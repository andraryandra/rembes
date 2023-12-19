<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateBendaharaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Nadia',
            'email' => 'nadia@gmail.com',
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

            'submission-artikel-list',

            'submission-approved-list',
            'submission-approved-create',
            'submission-approved-edit',
            'submission-approved-delete',

            'submission-success-list',
            'submission-success-create',
            'submission-success-edit',
            'submission-success-delete',

        ];

        // Menetapkan peran 'User' jika belum ada
        $role = Role::firstOrCreate(['name' => 'Bendahara']);

        // Menetapkan izin ke peran 'User'
        $role->syncPermissions($permissions);

        // Menetapkan peran 'User' ke pengguna yang baru dibuat
        $user->assignRole([$role->id]);
    }
}
