<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Answer;
use App\Good;


class SolveController extends Controller
{
    public function solve(Request $request, Post $post){
        //該当のポストテーブルにのステータスを変更すること
        Post::where('id', $post->id)->update(['state' => '解決済']);
        return response()->json();
    }
}
