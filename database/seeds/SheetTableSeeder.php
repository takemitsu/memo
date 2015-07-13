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
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
