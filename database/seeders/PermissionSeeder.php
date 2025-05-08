<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\RoleHasPermissions;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = [
            "role.view",
            "role.create",
            "role.edit",
            "role.delete",
        ];
        foreach($permissions as $key => $value){
            Permission::create([
                'name' => $value,
            ]);
        }

        $features = [
            'user',
            'office',
            'employee',
            'post',
            'category',
            'representative',
            'department',
            
        ];
    
        $actions = ['view', 'create', 'edit', 'delete'];
    
        foreach ($features as $feature) {
            foreach ($actions as $action) {
                Permission::firstOrCreate([
                    'name' => "{$feature}.{$action}",
                ]);
            }
        }
    }
}
