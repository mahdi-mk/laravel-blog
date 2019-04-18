@extends('layouts.updates-layout')

@section('title', 'New Role')

@section('content')
    <form action="/roles/new" method="post">
    @csrf
    Name : <input type="text" name="name">
    <input type="submit">
    </form>
@endsection