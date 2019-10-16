<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Post;
use App\Answer;
use App\Like;


class UserController extends Controller
{
    public function getLogout(){
        Auth::logout();
        return redirect()->route('top');    
    }

    public function mypage(){
        //質問解決済みの総数
        $count_solutions = Post::where('user_id', Auth::id())->where('state', '解決済')->count();
        //総質問数
        $count_posts = Post::where('user_id', Auth::id())->count();
        //解決率
        if($count_posts == 0){
            $resolution_rate = 0;
        }else{
            $resolution_rate = $count_solutions / $count_posts * 100;
            $resolution_rate = floor($resolution_rate);    
        }
        //未解決
        $count_not_solutions = $count_posts - $count_solutions;
        //いいねを押された回数
        $total_likes = Answer::where('user_id', Auth::id())->sum('total_likes');
        //回答総数
        $count_answers = Answer::where('user_id', Auth::id())->count();
        //高評価を押された回数
        $count_goods = Post::where('user_id', Auth::id())->sum('total_goods');
        //すべての質問
        $total_posts = Post::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(10);
        //未解決の質問
        $unsolved_post = Post::where('user_id', Auth::id())->where('state', '未解決')->orderBy('created_at', 'desc')->paginate(10);
        //解決済の質問
        $solved_post = Post::where('user_id', Auth::id())->where('state', '解決済')->orderBy('created_at', 'desc')->paginate(10);
        //回答した質問を取得
        $distinct_post_id = Answer::where('user_id', Auth::id())->groupBy('post_id')->get('post_id');
        $comment_post = [];
        foreach($distinct_post_id as $post_id){
            $comment_post[] = Post::where('id', $post_id->post_id)->first();
        }
        return view('mypage',[
            'user_name' => Auth::user()->name,
            'count_solutions' => $count_solutions,
            'count_posts' => $count_posts,
            'resolution_rate' => $resolution_rate,
            'count_not_solutions' => $count_not_solutions,
            'total_likes' => $total_likes,
            'count_answers' => $count_answers,
            'count_goods' => $count_goods,
            'total_posts' => $total_posts,
            'unsolved_post' => $unsolved_post,
            'solved_post' => $solved_post,
            'comment_post' => $comment_post,
        ]);
    }
}
