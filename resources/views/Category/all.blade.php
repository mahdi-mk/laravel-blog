@extends('layouts.post-layout')

@section('title', 'Categories')

@section('content')
<div class="card-columns">
    @foreach ($categories as $cat)
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

@endsection