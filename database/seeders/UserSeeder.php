<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name'=>'superadmin',
            'display_name'=>'Super Admin'
        ]);
        Role::create([
            'name'=>'company',
            'display_name'=>'Company'
        ]);
        Role::create([
            'name'=>'agent',
            'display_name'=>'Agent'
        ]);
        Role::create([
            'name'=>'sales',
            'display_name'=>'Sales'
        ]);

        $admin = User::create([
            'name'=>'RedExpo',
            'username'=>'redexpo',
            'avatar'=>'favicon.ico',
            'password'=>bcrypt('Redexpo@2030')
        ]);

        $admin->assignRole('superadmin');
    }
}
