@extends('layouts.layout')

@section('title', 'Explore')

@section('content')
        @foreach ($explore_articles as $article)
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
@endsection

@section('RightSide')
    <div class="card mb-3 card-box border-left-primary">
        <h6>Latest Articles - <a href="" class="link">See All</a></h6><hr>
        @foreach ($latest_articles as $article)
        <div class="card mb-3 post-box" style="margin-bottom:10px !important;">
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

@section('LeftSide')

@endsection