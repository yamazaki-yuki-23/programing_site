<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Answer;
use App\Like;
use App\Good;
use Illuminate\Support\Facades\Auth;

class AnswersController extends Controller
{

    public function index(){
        return view('no-sign');
    }

    public function store(Request $request, Post $post){
        $params = $request->validate([
            'answer' => 'required',
        ]);
        $answer = new Answer;
        $answer->post_id = $request->post_id;
        $answer->user_id = Auth::user()->id;
        $answer->answer_name = Auth::user()->name;
        $answer->content = $request->answer;
        $answer->save();
        
        $distinct_user_id = Answer::where('post_id', $request->post_id)->groupBy('user_id')->get('user_id');

        $answers = [];
        foreach($distinct_user_id as $user_id){
            $answers[] = Answer::where('user_id', $user_id->user_id)->where('post_id', $request->post_id)->orderBy('created_at', 'desc')->get();
        }
        $post = Post::where('id', $request->post_id)->first();

        $answer_ids = Answer::where('post_id', $request->post_id)->pluck('id');
        //いいね数の計算
        $j = 0;
        foreach($answer_ids as $answer_id){
            $defaultCount[$j] = Like::where('answer_id', $answer_id)->count();
            $j++;
        }
        //いいねを押下したかの計算
        $i = 0;
        foreach($answer_ids as $answer_id){
            $defaultLiked[$i] = Like::where([['user_id', Auth::id()],['answer_id', $answer_id],])->first(); 
            if(count($defaultLiked[$i]) == 0) {
                $defaultLiked[$i] = false;
            } else {
                $defaultLiked[$i] = true;
            }    
            $i++;
        }

        $defaultEvaluated = Good::where('user_id', Auth::id())->where('post_id', $request->post_id)->first();
        if(count($defaultEvaluated) == 0){
            $defaultEvaluated = false;
        }else{
            $defaultEvaluated = true;
        }
        $defaultGoodCount = Good::where('post_id', $request->post_id)->count();

        $defaultState = "";
        if(($post->state) == '未解決'){
            $defaultState = false;
        }else{
            $defaultState = true;
        }
        return view('show',[
            'post' => $post,
            'answers' => $answers,
            'user_id' => Auth::id(),
            'defaultLiked' => $defaultLiked,
            'defaultCount' => $defaultCount,
            'defaultEvaluated' => $defaultEvaluated,
            'defaultGoodCount' => $defaultGoodCount,
            'defaultState' => $defaultState,
        ]);
    }
}
