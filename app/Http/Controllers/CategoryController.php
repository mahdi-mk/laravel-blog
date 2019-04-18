<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\category;
use App\article;

class CategoryController extends Controller
{
    public function __construct()
    {
        // These methods are for authentecated users 
        $this->middleware('auth')->only(['create', 'store']);
    }

    public function index()
    {
        $categories = category::all();
        return view('Category.all', compact('categories'));
    }

    /**
     * return 'Create Category' page
     * < HTTP GET >
     */
    public function create()
    {
        // only superadmin and editor can create category
        if(Auth::user()->isA('superadmin') || Auth::user()->isAn('editor')){
            return view('Category.create');
        }
        else{
            return abort(403);
        }
    }

    /**
     * Store category in database
     * < HTTP POST >
     */
    public function store()
    {
        if(Auth::user()->isA('superadmin') || Auth::user()->isA('editor')){
            // Before create, Validate the inputs using 'ValidateCat' function
            category::create($this->ValidateCat());
            return redirect('/dashboard/categories');
        }
        else{
            return abort(403);
        }
    }

    // Show the category and return all articles that are in the category
    public function show(category $category)
    {
        return view('Category.show', compact('category'));
    }
    

    /**
     * Validate category
     */
    public function ValidateCat()
    {
        return request()->validate([
            'name' => 'required|min:3|max:15'
        ]);
    }
}
