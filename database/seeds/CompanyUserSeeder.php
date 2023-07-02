<?php

use Illuminate\Database\Seeder;

class CompanyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            'active' => 1,
            'first_name' => 'System Admin',
            'last_name' => 'Admin',
            'full_name' => 'System Admin',
            'company_name' => 'Extrahourz',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$AKnmpVIIv5XcBitGs/wm.elOdy4YPnEzh.QG2NZPhFe9i2u2uRbKC',
            'password_visible' => 'Test@123',
            'is_deleteable' => 0
        ]);

        \DB::table('role_user')->insert([
            'user_id' => 1,
            'role_id' => 4,
            'user_type' => 'App\Models\Boilerplate\User',
        ]);
    }
}
