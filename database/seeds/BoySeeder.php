<?php

use Illuminate\Database\Seeder;

class BoySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('boys')->insert([
            'username' => '田中大輔',
            'user_id' => 1,
            'old' => '22',
            'wantold' => '24',
            'area' => '東京都',
            'description' => 'OLのお姉さんに養われたいです！！',
        ]);
    }
}
