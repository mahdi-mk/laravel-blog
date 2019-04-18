@extends('layouts.updates-layout')

@section('title', 'Create Category')

@section('content')
<h3>Create New Category</h3>
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

    <form method="POST" action="/categories/create">
        {{ csrf_field() }}
            <div class="form-group">
              <label for="exampleFormControlInput1">name</label>
            <input name="name" type="text" class="form-control {{$errors->has('name') ? 'is-valid' : ''}}" id="exampleFormControlInput1" placeholder="Category Name" value="{{old('name')}}">
            </div>
            <button type="submit" class="btn btn-primary">Add Category</button>
          </form>
          <br>
@endsection