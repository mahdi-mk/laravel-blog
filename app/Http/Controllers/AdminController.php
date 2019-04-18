<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\article;
use App\User;
use App\category;

/**
 * this controller only for admin, in this controller admin can see all data in the blog.
 */
class AdminController extends Controller
{
    public function __construct()
    {
        // This methods are for authentecated users 
        $this->middleware('auth');
    }

    public function index()
    {
        // Only superadmin and editor can access this page
        if(Auth::user()->isA('superadmin') || Auth::user()->isAn('editor')){
            // all articles in the blog
            $articles = article::all();
            $articlesCount = $articles->count();

            // all users in the blog
            $users = User::all();
            $usersCount = $users->count();

            // all categories in the blog
            $cats = category::all();
            $catsCount = $cats->count();

            $images = article::orderBy('created_at', 'desc')->get()->pluck('image');
            $imagesCount = $images->count();

            return view('Admin.index', compact('articlesCount', 'usersCount', 'catsCount', 'imagesCount'));
        }
        // if the user is not a superadmin or an editor return abort 403
        else{
            return abort(403);
        }
    }

    public function articles()
    {
        if(Auth::user()->isA('superadmin') || Auth::user()->isAn('editor')){
            $articles = article::orderBy('created_at', 'desc')->get();
            return view('Admin.articles', compact('articles'));
        }
        else{
            return abort(403);
        }
    }

    public function categories(){
        if(Auth::user()->isA('superadmin') || Auth::user()->isAn('editor')){
            $categories = category::orderBy('created_at', 'desc')->get();
            return view('Admin.categories', compact('categories'));
        }
        else{
            return abort(403);
        }

    }

    public function users(){
        if(Auth::user()->isA('superadmin') || Auth::user()->isAn('editor')){
            $users = User::orderBy('created_at', 'desc')->get();
            return view('Admin.users', compact('users'));
        }
        else{
            return abort(403);
        }
    }
}
