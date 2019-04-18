<?php

namespace App\Policies;

use App\User;
use App\article;
use Illuminate\Auth\Access\HandlesAuthorization;
use Silber\Bouncer\Bouncer;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the article.
     *
     * @param  \App\User  $user
     * @param  \App\article  $article
     * @return mixed
     */
    public function update(User $user, article $article)
    {
        return $user->id === $article->Owner->id;
    }

    /**
     * Determine whether the user can delete the article.
     *
     * @param  \App\User  $user
     * @param  \App\article  $article
     * @return mixed
     */
    public function delete(User $user, article $article)
    {
        return $user->id === $article->Owner->id;
    }

}
