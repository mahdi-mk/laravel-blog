@extends('layouts.profile-layout')

@section('title')
Category: {{ $category->name }}
@endsection

@section('profile-details')
<div class="profile-panel">
    <div class="profile-panel">
        <div class="col-auto">
        </div>
    </div>
    <div>
        <h1><i class="fas fa-hashtag a-2x text-gray-300"></i> Category : {{ $category->name }}</h1>
        <p>There are {{ $category->articles->count() }} articles in {{ $category->name }}</p>
    </div>
</div>


@endsection

@section('articles')
    <div class="card-columns">
        @foreach ($category->articles as $article)
        <div class="card mb-3 post-box shadow">
            @if ($article->image != null)
                <img src="/uploads/images/{{ $article->image }}" class="card-img-top" alt="{{ $article->title }}" sizes="(max-width: 1024px) 100vw, 1024px">
            @endif
            <div class="card-body">
                <div class="post-author-date">
                    <p class="post-date">By </p>
                    <a href="{{ route('profile', ['user' => $article->owner->id,'slug' => $article->owner->slug]) }}" class="post-author">{{ $article->owner->name }}</a>
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