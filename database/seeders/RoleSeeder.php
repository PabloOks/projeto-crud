<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'admin',
            'description' => 'Administradores do sistema'
        ]);

        Role::create([
            'name' => 'default',
            'description' => 'Usuários padrão do sistema'
        ]);
    }
}
