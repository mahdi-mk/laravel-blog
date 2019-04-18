<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\article;
use App\category;
use Illuminate\Support\Facades\Input;

class SearchController extends Controller
{
    public function index()
    {
        $search = Input::get('search');
        // Search Users
        $users = User::where('name','LIKE','%'.$search.'%')->orWhere('email','LIKE','%'.$search.'%')->get();

        // Search Articles
        $articles = article::where('title', 'LIKE', '%'.$search.'%')->orWhere('description', 'LIKE', '%'.$search.'%')->get();

        // Search Categories
        $cats = category::where('name','LIKE','%'.$search.'%')->get();

        if(count($users) > 0 || count($articles) > 0){
            return view('Search.result', compact('users', 'articles', 'cats'))->withsearch($search);
        }
        else{
            return view('Search.NoResult');
        }
    }
}
