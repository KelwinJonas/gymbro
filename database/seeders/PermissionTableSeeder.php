<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_access',
            ],
            [
                'id'    => 2,
                'title' => 'exercicio_access',
            ],
            [
                'id'    => 3,
                'title' => 'treino_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
