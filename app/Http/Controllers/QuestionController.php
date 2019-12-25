<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Answer;
use App\Like;
use App\Good;
use Illuminate\Support\Facades\Auth;
use cebe\markdown\Markdown as Markdown;

class QuestionController extends Controller
{
    public function index(){
        $postList = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('list')->with('postList', $postList);
    }

    public function ask(){
        return view('ask');
    }

    public function store(Request $request){
        $params = $request->validate([
            'title' => 'required|max:50',
            'language' => 'required',
            'content' => 'required',
        ]);
        $post = new Post;
        $post->poster_name = Auth::user()->name;
        $post->user_id = Auth::user()->id;
        $post->title = $request->title;
        $post->language = $request->language;
        $post->content = $request->content;
        $post->save();
        return redirect('list');
    }

    public function show(Answer $answer ,$post_id){
        //いいね数、いいねボタン押下の判定による情報を取得
        $like_item = $this->like($post_id);

        $post = Post::findOrFail($post_id);
        $unique_user_id = Answer::where('post_id', $post_id)->groupBy('user_id')->get('user_id');
        //ユーザーごとの回答を取得
        $answers = [];
        foreach($unique_user_id as $user_id){
            $answers[] = Answer::where('user_id', $user_id->user_id)->where('post_id', $post_id)->get();
        }
        $count_answers = count($answers);

        //高評価数の取得、高評価ボタン押下の判定による情報を取得
        $good_item = $this->good($post_id);

        //質問のステータスを取得
        $defaultState = "";
        if(($post->state) == '未解決'){
            $defaultState = false;
        }else{
            $defaultState = true;
        }
        $parser = new Markdown();
        return view('show',[
            'post' => $post,
            'content' => $parser->parse($post->content),
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
