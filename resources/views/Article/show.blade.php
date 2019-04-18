@extends('layouts.post-layout')

@section('title')
    {{$article ->title}}
@endsection

@section('content')
    @if ($article->image != null)
    <div class="shadow" style="padding-top:20px; padding-bottom:20px; padding-left:20px; padding-right:20px; background:#fff;">
        <img src="/uploads/images/{{ $article->image }}" class="card-img-top" alt="{{ $article->title }}" sizes="(max-width: 1024px) 100vw, 1024px">
    </div>
    @endif
    <h1>
        {{ $article->title }}
        @can('update', $article)
            <a href="{{ route('article.edit', ['article' => $article->id]) }}" class="link" data-toggle="tooltip" data-placement="top" data-html="true" title="Only you can see this">Edit This Article</a>
        @endcan
    </h1>
    <div class="post-author-date">
        <p class="post-date">By </p>
        <a href="{{ route('profile', ['user' => $article->owner->id,'slug' => $article->owner->slug ]) }}" class="post-author">{{ $article->owner->name }}</a>
        <p class="post-date">{{ $article->created_at->toFormattedDateString() }} | </p>
        @if ($article->source != null)
            <p class="post-author"> {{ $article->source }}</p>
        @endif
    </div>

    <hr>
        {!! $article->body !!}
    <br>
    <hr>
    <h5>Ctegories</h5>
    @foreach ($article->categories as $category)
        <a href="{{ route('category.show', ['category' => $category->id, 'slug' => $category->slug]) }}" class="cat-box">{{ $category->name }}</a>
    @endforeach

    <hr>
    <h5>Related Articles</h5>
    <div class="card-columns">
        @foreach ($related_articles as $article)
        <div class="card mb-3 post-box">
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
    <br>
@endsection

@section('RightSide')
    {{-- <div class="mb-3 card">
        <div class="profile-box">
            <h6>Read More About Author</h6><hr>

            <img class="avatar" style="width:100px; height:100px; margin-right:0px;" src="/uploads/avatars/{{ $article->owner->avatar }}" alt="{{ $article->owner->name }}">
            <a href="{{ route('profile', ['user' => $article->owner->id ]) }}"><h3>{{ $article->owner->name }}</h3></a>
            <span class="email-span">{{ $article->owner->email }}</span>
            <p>{{ $article->owner->bio }}</p>
        </div>
    </div> --}}

@endsection