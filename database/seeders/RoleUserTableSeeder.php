<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    public function run()
    {
        User::find(1)->roles()->attach(1);
        User::find(2)->roles()->attach(2);
    }
}
