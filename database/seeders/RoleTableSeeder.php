<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'id'    => 1,
                'tipo_usuario' => 'Admin',
            ],
            [
                'id'    => 2,
                'tipo_usuario' => 'Professor',
            ],
            [
                'id'    => 3,
                'tipo_usuario' => 'Aluno',
            ],
        ];

        Role::insert($roles);
    }
}
