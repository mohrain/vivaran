<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $role = Role::findOrCreate('super-admin');
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'prvn@gmail.com',
            'password' => '$2y$12$cH3UK/yMotIT0kcFec4NnOImAlinQVO1yrNBqchugxfDp75rQK68O',
        ]);

        $user->assignRole($role);

        $role = Role::findOrCreate('admin');
        $user = User::create([
            'name' => 'Admin',
            'email' => 'vivaran.admin@gmail.com',
            'password' => '$2y$12$cH3UK/yMotIT0kcFec4NnOImAlinQVO1yrNBqchugxfDp75rQK68O',
        ]);

        $user->assignRole($role);
        $role = Role::findOrCreate('editor');
        $user = User::create([
            'name' => 'Editor',
            'email' => 'vivaran.editor@gmail.com',
            'password' => '$2y$12$cH3UK/yMotIT0kcFec4NnOImAlinQVO1yrNBqchugxfDp75rQK68O',
        ]);

        $user->assignRole($role);
        
    }
}
