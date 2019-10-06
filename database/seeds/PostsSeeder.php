<?php

use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'id' => 10,
            'poster_name' => '吉田',
            'user_id' => 10,
            'title' => '変数について',
            'language_id' => 1,
            'content' => '変数の定義方法がわかりません。',
        ]);
    }
}
