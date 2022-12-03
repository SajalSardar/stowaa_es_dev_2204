@extends('layouts.backendapp')
@section('title', 'Edit Role')
@section('content')
<div class="container-fluid page__heading-container">
  <div class="page__heading d-flex align-items-end">
    <div class="flex">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="{{ route('backend.home') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit Role</li>
        </ol>
      </nav>
      <h1 class="m-0">Role & Permission Edit</h1>
    </div>
  </div>
</div>

<div class="container-fluid page__container">
  <div class="card card-form">
    <div class="row no-gutters">
        <div class="card-form__body card-body">
            <form action="{{ route('backend.role.update', $role->id) }}" method="POST">
              @csrf
              @method('PUT')
                <div class="form-group">
                    <label>Role:</label>
                    <input type="text" class="form-control" name="name" value="{{ $role->name }}" placeholder="Add Role">
                </div>
                
                <div class="form-group">
                    <label>Select Permission:</label>
                    <br>
                    @foreach ($permissions as $permission)
                      <label class="col-lg-2 border-1 py-2">
                        <input type="checkbox" value="{{ $permission->id }}" name="permission[]" 
                        {{ in_array($permission->id, $role->permissions->pluck('id')->toArray()) ? "checked" : ''  }}
                        > {{ $permission->name }}
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