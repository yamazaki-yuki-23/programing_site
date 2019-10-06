<?php

use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            'id' => 1,
            'name' => 'PHP',
            'name_id' => 1,
        ]);
    }
}
