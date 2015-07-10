<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@takemitsu.net',
            'password' => bcrypt('flowadmin'),
            'is_admin' => true,
        ]);
        DB::table('users')->insert([
            'name' => 'guest',
            'email' => 'guest@takemitsu.net',
            'password' => bcrypt('flowguest'),
            'is_admin' => false,
        ]);
    }
}
