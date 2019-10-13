<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Answer;
use App\Like;
use App\Good;
use Illuminate\Support\Facades\Auth;

class BoyController extends Controller
{
    public function index(){
        $postList = Post::orderBy('created_at', 'desc')->paginate(5);
        return view('boy')->with('postList', $postList);
    }

    public function add(){
        if(Auth::check() ){
            $post = Post::where('user_id', Auth::id())->first();
            return view('boyadd')->with('post', $post);
        }
        return view('boyadd');
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

        return redirect('young');
    }

    public function show(Answer $answer ,$post_id){
        $answer->load('likes');
        // $defaultCount = count($answer->likes);
        $answer_ids = Answer::where('post_id', $post_id)->pluck('id');//誰が回答したのかID取得
        //いいね数の計算
        $j = 0;
        $defaultCount = [];
        foreach($answer_ids as $answer_id){
            $defaultCount[$j] = Like::where('answer_id', $answer_id)->count();
            $j++;
        }
        //いいねを押下したかの計算
        $i = 0;
        $defaultLiked = [];
        foreach($answer_ids as $answer_id){
            $defaultLiked[$i] = Like::where([['user_id', Auth::id()],['answer_id', $answer_id],])->first(); 
            if(count($defaultLiked[$i]) == 0) {
                $defaultLiked[$i] = false;
            } else {
                $defaultLiked[$i] = true;
            }    
            $i++;
        }
        $post = Post::findOrFail($post_id);
        $distinct_user_id = Answer::where('post_id', $post_id)->groupBy('user_id')->get('user_id');
        // $answers = Answer::where('post_id', $post_id)->get();
        $answers = [];
        foreach($distinct_user_id as $user_id){
            $answers[] = Answer::where('user_id', $user_id->user_id)->where('post_id', $post_id)->get();
        }
        // dd($answers);

        $defaultEvaluated = Good::where('user_id', Auth::id())->where('post_id', $post_id)->first();
        if(count($defaultEvaluated) == 0){
            $defaultEvaluated = false;
        }else{
            $defaultEvaluated = true;
        }
        $defaultGoodCount = Good::where('post_id', $post_id)->count();

        $defaultState = "";
        if(($post->state) == '未解決'){
            $defaultState = false;
        }else{
            $defaultState = true;
        }
        // dd($post->content);
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
