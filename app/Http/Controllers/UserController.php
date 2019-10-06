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
        //ユーザー名→Auth::user()->name、ユーザーID→Auth::id()
        //質問解決済みの総数取得
        $count_solutions = Post::where('user_id', Auth::id())->where('state', '解決済')->count();
        //質問総数
        $count_questions = Post::where('user_id', Auth::id())->count();
        if($count_questions == 0){
            $count_questions = 0;
        }
        //解決率
        $resolution_rate = $count_solutions / $count_questions * 100;
        $resolution_rate = floor($resolution_rate);
        //いいねを押された回数
        $total_likes = Answer::where('user_id', Auth::id())->sum('total_likes');
        //回答総数
        $count_answers = Answer::where('user_id', Auth::id())->count();
        //高評価を押された回数
        $count_goods = Post::where('user_id', Auth::id())->sum('total_goods');

        return view('mypage',[
            'user_name' => Auth::user()->name,
            'count_solutions' => $count_solutions,
            'count_questions' => $count_questions,
            'resolution_rate' => $resolution_rate,
            'total_likes' => $total_likes,
            'count_answers' => $count_answers,
            'count_goods' => $count_goods,
        ]);
    }

    public function question_list(){
        dd('aaa');
    }


}
