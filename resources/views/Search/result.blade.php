@extends('layouts.layout')

@section('title')
    {{ $search }}
@endsection

@section('content')
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link" id="articles-tab" data-toggle="tab" href="#articles" role="tab" aria-controls="articles" aria-selected="true">Articles</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="profiles-tab" data-toggle="tab" href="#profiles" role="tab" aria-controls="profiles" aria-selected="false">Profiles</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="categories-tab" data-toggle="tab" href="#categories" role="tab" aria-controls="categories" aria-selected="false">Categories</a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">

    <!--Articles-->
    <div class="tab-pane fade show active" id="articles" role="tabpanel" aria-labelledby="articles-tab">
        @if ($articles === null)
            <h1>No Articles</h1>
        @endif
        @foreach ($articles as $article)
        <div class="card mb-3 post-box">
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

    <div class="tab-pane fade" id="profiles" role="tabpanel" aria-labelledby="profiles-tab">
        @if ($users === null)
            <h1>No Profiles</h1>
        @endif
        @foreach ($users as $user)
            <div class="card mb-3 post-box" style="display:-webkit-box;">
                <div style="padding-top:5px; padding-bottom:5px; padding-left:5px; padding-right:5px;">
                    <img src="/uploads/avatars/{{ $user->avatar }}" alt="{{ $user->name }}" style="width:80px; height:80px; margin-right:20px; border-radius:5px;">
                </div>
                <div>
                    <h1>
                        <a class="post-title" href="{{ route('profile', ['user' => $user->id, 'slug' => $user->slug]) }}">
                            <h3 class="card-title">{{ $user->name }}</h3>
                        </a>
                        <span class="email-span">{{ $user->email }}</span>
                    </h1>
                </div>
            </div>
        @endforeach
    </div>

    <div class="tab-pane fade" id="categories" role="tabpanel" aria-labelledby="categories-tab">
        @foreach ($cats as $cat)
        <div class="card mb-3 post-box border-bottom-primary border-top-primary shadow">
            <div class="card-body">
                <a href="{{ route('category.show', ['category' => $cat->id, 'slug' => $cat->id]) }}" class="post-title">
                    <h2 class="card-title"><i style="margin-right:10px; color:gray; font-size:12px;" class="fas fa-tags"></i> {{ $cat->name }}</h2>
                </a>
                <hr>
                <p class="card-text post-body">{{ $cat->articles->count() }} Articles</p>
            </div>
        </div>
        @endforeach
    </div>
  </div>









@endsection