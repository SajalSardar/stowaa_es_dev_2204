@extends('layouts.backendapp')
@section('title', 'Create Role')
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
  <div class="card card-form">
    <div class="row no-gutters justify-content-center">
        <div class="col-lg-8 card-form__body card-body">
            <form action="{{ route('backend.permission.insert') }}" method="POST">
              @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Add Permissiopn:</label>
                    <input type="text" name="name" class="form-control" placeholder="Add Permission">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
  </div>

  <div class="card card-form">
    <div class="row no-gutters">
        <div class="card-form__body card-body">
            <form action="{{ route('backend.role.insert') }}" method="POST">
              @csrf
                <div class="form-group">
                    <label>Add Role:</label>
                    <input type="text" class="form-control" name="name" placeholder="Add Role">
                </div>
                <div class="form-group">
                    <label>Select Permission:</label>
                    <br>
                    @foreach ($permissions as $permission)
                      <label class="col-lg-2 border-1 py-2">
                        <input type="checkbox" name="permission[]" value="{{ $permission->id }}"> {{ $permission->name }}
                      </label>
                    @endforeach
                    
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
  </div>
</div>
@endsection