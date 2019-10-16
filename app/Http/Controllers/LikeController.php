<?php

namespace App\Http\Controllers;

use App\Post;
use App\Like;
use App\Answer;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(Request $request, Answer $answer){
        $like = Like::create(['user_id' => $request->user_id, 'answer_id' => $answer->id]);
        Answer::where('id', $answer->id)->update(['total_likes' => $answer->total_likes + 1]);
        $likeCount = count(Like::where('answer_id', $answer->id)->get());
        return response()->json(['likeCount' => $likeCount]);
    }

    public function unlike(Request $request, Answer $answer){
        $like = Like::where('user_id', $request->user_id)->where('answer_id', $answer->id)->first();
        $like->delete();
        Answer::where('id', $answer->id)->update(['total_likes' => $answer->total_likes - 1]);
        $likeCount = count(Like::where('answer_id', $answer->id)->get());
        return response()->json(['likeCount' => $likeCount]);
    }
}
