<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;

class SearchController extends Controller
{
    public function index(Request $request){
        $params = $request->validate([
            'keyword' => 'required|not_in',
        ]);

        $keyword = $request->input('keyword');
        $postList = Post::where('content', 'LIKE', "%$keyword%")->orWhere('title', 'LIKE', "%$keyword%")->orWhere('language', 'LIKE', "%$keyword%")->paginate(10);
        $count = count($postList);    

        return view('search',[
            'postList' => $postList,
            'keyword' => $keyword,
            'count' => $count,
        ]);
    }
}
