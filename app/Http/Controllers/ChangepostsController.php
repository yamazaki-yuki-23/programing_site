<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;

class ChangepostsController extends Controller
{
    public function index(Request $request){
        if($request->language == 'All'){
            $postList = Post::orderBy('created_at', 'desc')->paginate(5);
        }else{
            $postList = Post::where('language', $request->language)->orderBy('created_at', 'desc')->get();
        }
        return view('boy')->with('postList', $postList);
    }

}
