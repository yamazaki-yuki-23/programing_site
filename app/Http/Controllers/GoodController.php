<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Answer;
use App\Good;


class GoodController extends Controller
{
    public function good(Request $request, Post $post){
        $goods = Good::create(['user_id' => $request->user_id, 'post_id' => $post->id]);
        Post::where('id', $post->id)->update(['total_goods' => $post->total_goods + 1]);
        $goodCount = count(Good::where('post_id', $post->id)->get());
        return response()->json(['goodCount' => $goodCount]);
    }

    public function ungood(Request $request, Post $post){
        $goods = Good::where('user_id', $request->user_id)->where('post_id', $post->id)->first();
        $goods->delete();
        Post::where('id', $post->id)->update(['total_goods' => $post->total_goods - 1]);
        $goodCount = count(Good::where('post_id', $post->id)->get());
        return response()->json(['goodCount' => $goodCount]);
    }
}
