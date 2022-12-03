@extends('layouts.backendapp')
@section('title', 'All Role')
@section('content')
  <div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-end">
      <div class="flex">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('backend.home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Role</li>
          </ol>
        </nav>
        <h1 class="m-0">Role & Permission</h1>
      </div>
    </div>
  </div>

  <div class="container-fluid page__container">
    
      <div class="row no-gutters">
        <div class="col-lg-12 card-form__body">

          <div class="card">
            <div class="card-header">
              <h3>Role  
                @can('add role')
                <a href="{{ route('backend.role.create') }}" class="btn btn-primary btn-sm">Create Role</a>
                @endcan
              </h3>
            </div>
            <div class="card-body">
              <div class="table-responsive border-bottom">

                <table class="table">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Permission</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($roles as $role)
                    <tr>
                      <td>{{ $role->id }}</td>
                      <td>{{ $role->name }}</td>
                      <td>
                        @foreach ($role->permissions as $permission)
                          <span class="btn btn-sm btn-info">{{ $permission->name }}</span>
                        @endforeach
                      </td>
                      <td>
                        @can('see role')
                        <a href="#" class="btn btn-sm btn-primary">View</a>
                        @endcan
                        @can('edit role')
                        <a href="{{ route('backend.role.edit', $role->id) }}" class="btn btn-sm btn-info">Edit</a>
                        @endcan
                        @can('delete role')
                        <a href="#" class="btn btn-sm btn-danger">Delete</a>
                        @endcan
                      </td>
                    </tr>
                    @endforeach
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
      </div>
   


  </div>
@endsection
