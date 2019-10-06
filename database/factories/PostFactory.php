<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'poster_name' => '吉田',
        'user_id' => '10',
        'title' => '変数について',
        'language' => 'PHP',
        'content' => '変数の定義方法がわかりません。',
    ];
});
