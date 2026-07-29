<?php

namespace Database\Seeders;

use App\Enums\AdminRole;
use App\Enums\AdminStatus;
use App\Models\Admin;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'superadmin@gmail.com'],
            [
                'name' => 'AbdulQadir',
                'password' => 'Something#Crazy',
                'role' => AdminRole::SuperAdmin,
                'status' => AdminStatus::Approved,
                'email_verified_at' => now(),
            ]
        );
    }
}