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
        
        //いいね数、いいねボタン押下の判定による情報を取得
        $like_item = $this->like($request->post_id);

        $post = Post::findOrFail($request->post_id);
        $unique_user_id = Answer::where('post_id', $request->post_id)->groupBy('user_id')->get('user_id');
        //ユーザーごとの回答を取得
        $answers = [];
        foreach($unique_user_id as $user_id){
            $answers[] = Answer::where('user_id', $user_id->user_id)->where('post_id', $request->post_id)->get();
        }
        $count_answers = count($answers);

        //高評価数の取得、高評価ボタン押下の判定による情報を取得
        $good_item = $this->good($request->post_id);

        //質問のステータスを取得
        $defaultState = "";
        if(($post->state) == '未解決'){
            $defaultState = false;
        }else{
            $defaultState = true;
        }

        $defaultState = "";
        if(($post->state) == '未解決'){
            $defaultState = false;
        }else{
            $defaultState = true;
        }
        return view('show',[
            'post' => $post,
            'answers' => $answers,
            'count_answers' => $count_answers,
            'user_id' => Auth::id(),
            'defaultLiked' => $like_item['defaultLiked'],
            'defaultLikeCount' => $like_item['defaultLikeCount'],
            'defaultEvaluated' => $good_item['defaultEvaluated'],
            'defaultGoodCount' => $good_item['defaultGoodCount'],
            'defaultState' => $defaultState,
        ]);
    }

    public function like($post_id){
        //回答ごとのいいね数を取得
        $multiple_answer_id = Answer::where('post_id', $post_id)->pluck('id');
        $like_index = 0;
        $defaultLikeCount = [];
        foreach($multiple_answer_id as $answer_id){
            $defaultLikeCount[$like_index] = Like::where('answer_id', $answer_id)->count();
            $like_index++;
        }

        //いいねを押下したかの判定
        $like_index = 0;
        $defaultLiked = [];
        foreach($multiple_answer_id as $answer_id){
            $defaultLiked[$like_index] = Like::where([['user_id', Auth::id()],['answer_id', $answer_id],])->count(); 
            if($defaultLiked[$like_index] == 0) {
                $defaultLiked[$like_index] = false;
            } else {
                $defaultLiked[$like_index] = true;
            }    
            $like_index++;
        }
        $like_item = [
            'defaultLikeCount' => $defaultLikeCount,
            'defaultLiked' => $defaultLiked,
        ];
        return $like_item;
    }

    public function good($post_id){
        //高評価数の取得
        $defaultGoodCount = Good::where('post_id', $post_id)->count();

        //ログインユーザーが高評価ボタンを押下しているか判定
        $defaultEvaluated = Good::where('user_id', Auth::id())->where('post_id', $post_id)->count();
        if($defaultEvaluated == 0){
            $defaultEvaluated = false;
        }else{
            $defaultEvaluated = true;
        }
        $good_item = [
            'defaultGoodCount' => $defaultGoodCount,
            'defaultEvaluated' => $defaultEvaluated,
        ];
        return $good_item;
    }


}
