@extends('layouts.admin-layout')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Articles</h1>
            <a href="{{ route('article.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Create Article</a>
            </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Articles</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">

        <input type="text" id="myInput" class="form-control form-control-sm" onkeyup="myFunction()" style="margin-bottom:5px;" placeholder="Search" title="Type in a name">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Owner</th>
                <th>Description</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody id="myTable">
                @foreach ($articles as $article)
                    <tr>
                        <td>{{ $article->id }}</td>
                        <td>{{ $article->title }}</td>
                        <td><a href="{{ route('profile', ['user' => $article->owner->id, 'slug' => $article->owner->slug ]) }}">{{ $article->owner->name }}</a></td>
                        <td>{{ $article->description }}</td>
                        <td>
                            <a href="{{ route('article.edit', ['article' => $article->id] ) }}" class="btn btn-info btn-circle">
                                    <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('article.destroy', ['article' => $article->id] ) }}" class="btn btn-danger btn-circle">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>
        </div>
    </div>
    </div>

    <script>
        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
            });
        });
    </script>

@endsection