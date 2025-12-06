<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([

            // 🧑 User
            ['id' => 1, 'name' => 'User.view', 'module' => 'User', 'guard_name' => 'web'],
            ['id' => 2, 'name' => 'User.create', 'module' => 'User', 'guard_name' => 'web'],
            ['id' => 3, 'name' => 'User.edit', 'module' => 'User', 'guard_name' => 'web'],
            ['id' => 4, 'name' => 'User.delete', 'module' => 'User', 'guard_name' => 'web'],

            // 🧩 Role
            ['id' => 5, 'name' => 'Role.view', 'module' => 'Role', 'guard_name' => 'web'],
            ['id' => 6, 'name' => 'Role.create', 'module' => 'Role', 'guard_name' => 'web'],
            ['id' => 7, 'name' => 'Role.edit', 'module' => 'Role', 'guard_name' => 'web'],
            ['id' => 8, 'name' => 'Role.delete', 'module' => 'Role', 'guard_name' => 'web'],

            // 🔑 Password
            ['id' => 9, 'name' => 'Password.view', 'module' => 'Password', 'guard_name' => 'web'],
            ['id' => 10, 'name' => 'Password.create', 'module' => 'Password', 'guard_name' => 'web'],

            // 🏢 Agency
            ['id' => 11, 'name' => 'Agency.view', 'module' => 'Agency', 'guard_name' => 'web'],
            ['id' => 12, 'name' => 'Agency.create', 'module' => 'Agency', 'guard_name' => 'web'],

            // ⚙️ Configuration
            ['id' => 13, 'name' => 'Configuration.view', 'module' => 'Configuration', 'guard_name' => 'web'],
            ['id' => 14, 'name' => 'Configuration.create', 'module' => 'Configuration', 'guard_name' => 'web'],

            // 💰 Accounts
            ['id' => 15, 'name' => 'Accounts.view', 'module' => 'Accounts', 'guard_name' => 'web'],
            ['id' => 16, 'name' => 'Accounts.create', 'module' => 'Accounts', 'guard_name' => 'web'],
            ['id' => 17, 'name' => 'Accounts.edit', 'module' => 'Accounts', 'guard_name' => 'web'],
            ['id' => 18, 'name' => 'Accounts.delete', 'module' => 'Accounts', 'guard_name' => 'web'],

            // 📈 Report
            ['id' => 19, 'name' => 'Report.view', 'module' => 'Report', 'guard_name' => 'web'],
            ['id' => 20, 'name' => 'Report.create', 'module' => 'Report', 'guard_name' => 'web'],
            ['id' => 21, 'name' => 'Report.edit', 'module' => 'Report', 'guard_name' => 'web'],
            ['id' => 22, 'name' => 'Report.delete', 'module' => 'Report', 'guard_name' => 'web'],
        ]);
    }
}
