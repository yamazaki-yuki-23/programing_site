<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Like;
use Illuminate\Support\Facades\Auth;

class NavController extends Controller
{
    public function index($item){
        switch($item){
            //未解決の投稿を取得
            case 'no_solve':
                $postList = Post::where('state', '未解決')->orderBy('created_at', 'desc')->paginate(5);
                break;
            //解決済の投稿を取得
            case 'solved':
                $postList = Post::where('state', '解決済')->orderBy('created_at', 'desc')->paginate(5);
                break;
            //高評価順に投稿を取得
            case 'popular':
                $postList = Post::orderBy('total_goods', 'desc')->orderBy('created_at', 'desc')->paginate(5);
                break;
            }
        return view('list')->with('postList', $postList);
    }
}
