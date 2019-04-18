@extends('layouts.layout')

@section('title', 'Home')

@section('content')
    @foreach ($articles as $article)
    <div class="card mb-3 post-box shadow">
        @if ($article->image != null)
            <img src="/uploads/images/{{ $article->image }}" class="card-img-top" alt="{{ $article->title }}" sizes="(max-width: 1024px) 100vw, 1024px">
        @endif
        <div class="card-body">
            <div class="post-author-date">
                <p class="post-date">By </p>
                <a href="{{ route('profile', ['user' => $article->owner->id, 'slug' => $article->owner->slug ]) }}" class="post-author">{{ $article->owner->name }}</a>
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
    {{ $articles->links() }}

@endsection


<!-- Left Sidebar-->
@section('LeftSide')
@auth
    <div class="mb-3 card shadow border-left-primary">
        <div class="profile-box">
            <img class="avatar" style="width:100px; height:100px; margin-right:0px;" src="/uploads/avatars/{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}">
            <a href="{{ route('profile', ['user' => Auth::user()->id, 'slug' => Auth::user()->slug ]) }}"><h3>{{ Auth::user()->name }}</h3></a>
            <span class="email-span">{{ Auth::user()->email }}</span>
            <p>{{ Auth::user()->bio }}</p>
        </div>
    </div>

    <div class="mb-3 card card-box shadow border-left-primary">
        <h6>About - <a href="{{ route('profile.edit', ['user' => Auth::user()->id ]) }}#about" class="link">Edit</a></h6><hr>
        <p style="margin-bottom:5px; font-size:15px"><i style="margin-right:10px;" class="fas fa-home text-gray-300"></i> {{ Auth::user()->lives_in }}</p>
        <p style="margin-bottom:5px; font-size:15px"><i style="margin-right:10px;" class="fas fa-map-marker-alt text-gray-300"></i> {{ Auth::user()->from }}</p>
        <p style="margin-bottom:5px; font-size:15px"><i style="margin-right:10px;" class="fas fa-graduation-cap text-gray-300"></i> {{ Auth::user()->studied_at }}</p>
        <p style="margin-bottom:5px; font-size:15px"><i style="margin-right:10px;" class="fas fa-briefcase text-gray-300"></i> {{ Auth::user()->works_at }}</p>
        <p style="margin-bottom:5px; font-size:15px"><i style="margin-right:10px;" class="fas fa-link text-gray-300"></i> <a href="{{ Auth::user()->website }}">{{ Auth::user()->website }}</a></p>

    </div>

@endauth

@guest
    <div class="join-panel">
        <h4 style="margin-bottom:30px;">Join Now!!</h4>
        <a style="font-size:20px" class="login-btn" href="{{ route('login') }}">LOGIN</a>
        <a style="font-size:20px" class="register-btn" href="{{ route('register') }}">Register</a>
        <p style="margin-top:40px;">TO BE A MEMBER IN OUR BLOG AND CREATE YOUR OWN ARTICLES </p>
    </div>
@endguest
@endsection


<!-- Right Sidebar-->
@section('RightSide')
<div class="card mb-3 card-box shadow border-left-primary">
    <h6 style="color:#47c9e5;">Random Articles - <a href="" class="link">See All</a></h6><hr>
    @foreach ($random_articles as $article)
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


<div class="card mb-3 card-box shadow border-left-primary">
    <h6 style="color:#47c9e5;">Discover People - <a href="" class="link">See All</a></h6><hr>
    @foreach ($people as $person)
    <div class="card mb-3 post-box" style="display:-webkit-box; margin-bottom:10px !important;">
        <div style="padding-top:5px; padding-bottom:5px; padding-left:5px; padding-right:5px;">
            <img src="/uploads/avatars/{{ $person->avatar }}" alt="{{ $person->name }}" style="width:80px; height:80px; margin-right:20px; border-radius:5px;">
        </div>
        <div>
            <h1>
                <a class="post-title" href="{{ route('profile', ['user' => $person->id, 'slug' => $person->slug]) }}">
                    <h5 class="card-title">{{ $person->name }}</h5>
                </a>
                <span class="email-span" style="font-size:13px;">{{ $person->posts->count() }} Articles</span>
            </h1>
        </div>
    </div>
    @endforeach
</div>

@endsection


