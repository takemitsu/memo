<?php

use Illuminate\Database\Seeder;

class SheetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date('Y-m-d H:i:s');;
        DB::table('sheets')->insert([
            'title' => 'hoge',
            'text' => 'foobar',
            'user_id' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('sheets')->insert([
            'title' => 'hoge2',
            'text' => 'foobar2',
            'user_id' => 2,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
