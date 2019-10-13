<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;

class SearchController extends Controller
{
    public function index(Request $request){
        if($request->input('keyword') == null){
            $keyword = $request->input('keyword');
            $posts = '';
            $count = 0;    
        }else{
            $keyword = $request->input('keyword');
            $posts = Post::where('content', 'LIKE', "%$keyword%")->orWhere('title', 'LIKE', "%$keyword%")->orWhere('language', 'LIKE', "%$keyword%")->paginate(10);
            $count = count($posts);    
        }
        return view('search',[
            'posts' => $posts,
            'keyword' => $keyword,
            'count' => $count,
        ]);
    }
}
