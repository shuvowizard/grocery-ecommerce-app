<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a new Admin user
        $admin = new Admin();
        $admin->name = 'Admin';
        $admin->email = 'admin@me.com';
        $admin->password = 'password';
        $admin->token = null;
        $admin->token_expires_at = null;
        $admin->save();
    }
}
