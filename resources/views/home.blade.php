@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Users') }}
                    @can('add user')
                    <a href="#" class="btn btn-success btn-sm ml-2">Add User</a>
                    @endcan
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                @foreach ($user->roles as $role)
                                    <span class="btn btn-primary btn-sm">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @can('see user')
                                <a href="#" class="btn btn-success btn-sm">View</a>
                                @endcan
                                @can('edit user')
                                <a href="#" class="btn btn-primary btn-sm">Edit</a> 
                                @endcan
                                
                                @can('delete user')
                                <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                @endcan
                                

                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
