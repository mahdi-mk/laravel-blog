@extends('layouts.updates-layout')

@section('title')
    {{$user->name}} - edit
@endsection

@section('content')
    <h3>Edit Profile</h3>
    <hr>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <h3>Account</h3>
    <form enctype="multipart/form-data" method="POST" action="/profile/{{ $user->id }}">
        {{ method_field('PATCH')}}
        {{ csrf_field() }}

            <div class="form-group">
              <label for="name">Name <small><i>(required)</i></small></label>
                <input name="name" for="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" placeholder="Name" value="{{$user->name}}">
            </div>

            <div class="form-group">
                <label for="bio">{{ __('Bio') }} <small><i>(optional)</i></small></label>
                    <textarea cols="20" rows="10" id="bio" type="text" class="form-control{{ $errors->has('bio') ? ' is-invalid' : '' }}" name="bio">{{ $user->bio }}</textarea>
            </div>

            <div class="form-group">
                <div class="custom-file">
                    <input name="avatar" type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
                    <label class="custom-file-label" for="avatar">{{ $user->avatar }}</label>
                </div>
            </div>

            <br><hr><br>

            <h3 id="about">About</h3>

            <div class="form-group">
                <label for="lives_in">Lives in <small><i>(optional)</i></small></label>
                <input name="lives_in" for="lives_in" type="text" class="form-control{{ $errors->has('lives_in') ? ' is-invalid' : '' }}" id="lives_in" placeholder="Where do you live?" value="{{$user->lives_in}}">
            </div>
            <div class="form-group">
                <label for="from">From <small><i>(optional)</i></small></label>
                <input name="from" for="from" type="text" class="form-control{{ $errors->has('from') ? ' is-invalid' : '' }}" id="from" placeholder="Where are you from?" value="{{$user->from}}">
            </div>
            <div class="form-group">
                <label for="works_at">Works at <small><i>(optional)</i></small></label>
                <input name="works_at" for="works_at" type="text" class="form-control{{ $errors->has('works_at') ? ' is-invalid' : '' }}" id="works_at" placeholder="What do you work?" value="{{$user->works_at}}">
            </div>
            
            <div class="form-group">
                <label for="studied_at">Studied at <small><i>(optional)</i></small></label>
                <input name="studied_at" for="studied_at" type="text" class="form-control{{ $errors->has('studied_at') ? ' is-invalid' : '' }}" id="studied_at" placeholder="Where did you study?" value="{{$user->studied_at}}">
            </div>

            <div class="form-group">
                <label for="website">Website <small><i>(optional)</i></small></label>
                <input name="website" for="website" type="text" class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}" id="website" placeholder="Your website or any social media account link..." value="{{$user->website}}">
            </div>


            <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
    <br><br><br><br><br><br>
@endsection