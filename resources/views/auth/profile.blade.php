@extends('layouts.profile-layout')

@section('title')
    {{ $user->name }}
@endsection

@section('profile-details')
<div class="profile-panel">
    <div>
        <img class="avatar border-left-primary" src="/uploads/avatars/{{ $user->avatar }}" alt="{{ $user->name }}">
    </div>
    
    <div>
        <h1>
            <span class="name-span">{{ $user->name }}
            </span>
            <span class="email-span">{{ $user->email }}
                @auth
                    @if($user->id === Auth::user()->id)
                        <a href="{{ route('profile.edit', ['user' => Auth::user()->id ]) }}" class="link">| <strong>Edit Profile</strong></a>
                    @endif
                @endauth
            </span>
        </h1>
        <p>{{ $user->bio }}</p>
        <a href="{{ $user->website }}">{{ $user->website }}</a>
    </div>
</div>

<div>
    <div class="container border-bottom-primary" style="padding:10px; border-radius:5px; display:flex">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4" style="text-align:center;">
                    <h5>{{ $user->posts->count() }} Articles</h5>
                </div>
                <div class="col-md-4" style="text-align:center;">
                    <h5>0 Followers</h5>
                </div>
                <div class="col-md-4" style="text-align:center;">
                    <h5>0 Following</h5>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('articles')
<br>
    <div class="card-columns">
        @foreach ($articles as $article)
        <div class="card mb-3 post-box shadow">
            @if ($article->image != null)
                <img src="/uploads/images/{{ $article->image }}" class="card-img-top" alt="{{ $article->title }}" sizes="(max-width: 1024px) 100vw, 1024px">
            @endif
            <div class="card-body">
                <div class="post-author-date">
                    <p class="post-date">By </p>
                    <a href="{{ route('profile', ['user' => $article->owner->id, 'slug' => $article->owner->slug]) }}" class="post-author">{{ $article->owner->name }}</a>
                    <p class="post-date">{{ $article->created_at->toFormattedDateString() }}</p>
                </div>
                <a href="{{ route('article.show', ['article' => $article->id, 'slug' => $article->slug]) }}" class="post-title">
                    <h2 class="card-title">{{ $article->title }}</h2>
                </a>
                <p class="card-text post-body">{{ $article->description }}</p>
                <hr>
                <div class="post-cateories">
                    @if ($article->categories->count() != 0)
                        <i style="margin-right:10px; color:gray; font-size:12px;" class="fas fa-tags"></i>
                    @endif
                    @foreach ($article->categories as $category)
                        <a href="{{ route('category.show', ['category' => $category->id, 'slug' => $category->slug]) }}">{{ $category->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection

