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
            'email' => 'admin@nsp.bz',
            'password' => bcrypt('flowadmin'),
            'is_admin' => true,
        ]);
        DB::table('users')->insert([
            'name' => 'guest',
            'email' => 'guest@nsp.bz',
            'password' => bcrypt('flowguest'),
            'is_admin' => false,
        ]);
    }
}
