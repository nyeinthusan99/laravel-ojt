<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'NTS',
            'email' => 'nts@gmail.com',
            'password' => bcrypt('password'),
            'profile' => 'storage/man.png',
            'type' => 0,
            'created_user_id' => 1,
            'updated_user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => NULL,
        ]);

        DB::table('users')->insert([
            'name' => 'PPA',
            'email' => 'ppa@gmail.com',
            'password' => bcrypt('password'),
            'profile' => 'storage/man.png',
            'type' => 1,
            'created_user_id' => 1,
            'updated_user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => NULL,
        ]);
    }
}
