@extends('layouts.updates-layout')

@section('title', 'Assign Role')

@section('content')
    <form action="/roles/assign" method="post">
    @csrf
    Assign -Role- : <input type="text" name="role"> to 
    -UserId- : <input type="text" name="userId">

    <input type="submit">
    </form>
@endsection