<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;

class SearchController extends Controller
{
    public function index(Request $request){
        $params = $request->validate([
            'keyword' => 'required',
        ]);
        $keyword = $request->keyword;
        //DBに検索キーワードがあるか確認
        $posts = Post::where('content', 'LIKE', "%$keyword%")->orWhere('title', 'LIKE', "%$keyword%")->orWhere('language', 'LIKE', "%$keyword%")->paginate(10);
        
        return view('search',[
            'posts' => $posts,
            'keyword' => $keyword,
        ]);
    }
}
