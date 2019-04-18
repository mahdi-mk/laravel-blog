<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\article;
use App\User;
use App\Policies\ArticlePolicy;
use App\Comment;
use App\Policies\CommentPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        article::class => ArticlePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update_article', 'App\Policies\ArticlePolicy@update');
        Gate::define('delete_article', 'App\Policies\ArticlePolicy@delete');
    }
}
