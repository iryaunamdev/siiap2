<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name'=>'admin']);

        $user1 = User::create([
            'name' => 'Administrador',
            'email' => 'admin@mail.com',
            'password' => Hash::make('secret'),
        ]);

        $user1->assignRole('admin');
    }
}
