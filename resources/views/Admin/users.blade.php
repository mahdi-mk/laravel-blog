@extends('layouts.admin-layout')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Users</h1>
            </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Users</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <input type="text" id="myInput" class="form-control form-control-sm" onkeyup="myFunction()" style="margin-bottom:5px;" placeholder="Search" title="Type in a name">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>ID</th>
                <th>Avatar</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Slug</th>
                <th>Articles Count</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody id="myTable">
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><img style="height:40px; width:40px;" src="/uploads/avatars/{{ $user->avatar }}" alt="{{ $user->name }}"></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->getRoles() }}</td>
                        <td>{{ $user->slug }}</td>
                        <td>{{ $user->posts->count() }}</td>
                        <td>
                            <a href="{{ route('profile', ['user' => $user->id, 'slug' => $user->slug] ) }}" class="btn btn-info btn-circle">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('profile.edit', ['user' => $user->id] ) }}" class="btn btn-info btn-circle">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td>
                            <form method="POST" action="/profile/{{$user ->id}}">
                                {{ method_field('DELETE')}}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></button>
                            </form>
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