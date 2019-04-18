<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\UrlGenerator;
use App\article;
use App\category;
use App\User;
use Carbon\Carbon;
use App\Mail\ArticleCreatedMail;
use App\Events\ArticleCretaedEvent;
use App\Policies\ArticlePolicy;
use App\ArticleCategory;
use Image;

class ArticleController extends Controller
{
    public function __construct()
    {
        // This methods are for authentecated users 
        $this->middleware('auth')->only(['create', 'store', 'destroy', 'edit', 'update']);
    }

    /**
     * Get related articles that are in the same category
     *
     * @param  \App\article  $article (current article)
     * @return mixed
     */
    public function RelatedArticles(article $article)
    {
        // Get all categories for current article
        $article_cats = $article->categories;

        $articles = ArticleCategory::whereIn('category_id', $article_cats)->orderBy('created_at', 'desc')->take(3)->get()->pluck('article_id');
        $related_articles = article::whereIn('id', $articles)->get();

        return $related_articles;
    }

    /**
     * Send flash message
     * 
     * @param string $message
     * @param string $key
     * @return mixed
     */
    public function FlashMessage($key, $message)
    {
        return session()->flash($key, $message);
    }

    /**
     * the home page that shows all articles, categories, random articles and users.
     */
    public function index()
    {
        $articles = article::orderBy('created_at', 'desc')->paginate(15);
        $random_articles = $articles->random(3);

        $users = User::all();
        $people = $users->random(3);

        return view('Article.index', compact('articles', 'random_articles', 'people'));
    }

    /**
     * help user to find more articles and categories.
     */
    public function explore()
    {
        $articles = article::all();
        $explore_articles = $articles->random(3); // change the number if you want
        $latest_articles = article::orderBy('created_at', 'desc')->take(3)->get();

        $users = User::all();
        $random_users = $users->random(3);

        return view('Article.explore', compact('explore_articles', 'latest_articles', 'random_users'));
    }

    /**
     * return 'Create article' page
     * < HTTP GET >
     */
    public function create()
    {
        $categories = category::all();
        return view('Article.create', compact('categories'));
    }

    /**
     * Store article in database
     * < HTTP POST >
     */
    public function store(article $article, Request $request)
    {
        // Validate inputs using 'ValidateArticle' function
        $attributes = $this->ValidateArticle();
        $attributes['owner_id'] = auth()->id();

        // Post Image
        $image = $request->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        Image::make($image)->save('uploads/images/' . $filename);
        $attributes['image'] = $article->image = $filename;

        // Create article
        $article = article::create($attributes);

        // sync the categories
        $cats = request('cats');
        $article->categories()->sync($cats);

        // listen to the event
        event(new ArticleCretaedEvent($article));
        
        // Send flash message
        session()->flash('ArticleCreatedMessage', 'Your article has been created successfully.');

        return redirect('/');
    }

    // HTTP GET
    public function edit(article $article)
    {
        // Only article owner can edit 
        if(Gate::allows('update_article', $article)){
            $categories = category::all();
            return view('Article.edit', compact('article', 'categories'));
        }
        // return '403' error if the user is not the article owner
        return abort(403);
    }

    // HTTP PATCH
    public function update(article $article, Request $request)
    {
        // Only article owner can edit 
        if(Gate::allows('update_article', $article)){
            $attributes = $this->ValidateArticle();
            if ($request->image != null) {
                // Post Image
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->save('uploads/images/' . $filename);
                $attributes['image'] = $article->image = $filename;
            }
            $article->update($attributes);
            return redirect('/');
        }
        // return '403' error if the user is not the article owner
        return abort(403);
    }

    // HTTP DELETE
    public function destroy(article $article)
    {
        // Only article owner can delete 
        if(Gate::allows('delete_article', $article)){
            $article ->delete();
            $this->FlashMessage('ArticleDeleted', 'Your article has been deleted [ id: '. $article->id . ' ]');
            return redirect('/');
        }
        // return '403' error if the user is not the article owner
        return abort(403);
    }

    // HTTP GET
    public function show(article $article)
    {
        // Get related articles
        $related_articles = $this->RelatedArticles($article);
        return view('Article.show', compact('article', 'related_articles'));
    }


    /**
    * Validate article
    */
    public function ValidateArticle()
    {
        return request()->validate([
            'title' => 'required|min:3|max:50',
            'body' => 'required|min:3|max:9000',
            'description' => 'nullable|min:3|max:225',
            'source' => 'nullable',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024|dimensions:min_width=100,min_height=200'
        ]); 
    }
}