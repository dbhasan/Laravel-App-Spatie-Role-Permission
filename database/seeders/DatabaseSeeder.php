<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    private $roles = [
        'Master Admin',
        'Super Admin',
        'Admin',
        'manager',
        'finance',
        'users',
    ];

    public function run(): void
    {
        foreach ($this->roles as $role) {
            Role::create([
                'name' => $role,
                'guard_name' => 'web'
            ]);
        };

        $this->call([
            PermissionSeeder::class,
        ]);


        // User Create
        $user = User::create([
            'name' => 'Master Admin',
            'email' => 'ahasan.jobs@gmail.com',
            'number' => '8801723629080',
            'password' => Hash::make('12345678'),
            'role_id' => '1',
            'status' => '1',
        ]);


        $role = Role::find(1);

        if ($role && $role->id == 1) {
            $permissions = Permission::pluck('id')->toArray();
            $role->syncPermissions($permissions);
        }

        // Assign role to user
        $user->syncRoles([$role->id]);
    }
}
