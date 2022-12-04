@extends('layouts.backendapp')

@section('title', 'Product Category')

@section('content')
    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex align-items-end">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('backend.home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Product Category</li>
                    </ol>
                </nav>
                <h1 class="m-0">Product Category</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid page__container">

        <div class="row">

            <div class="col-lg-8 table-responsive">
                <div class="card">
                    <div class="card-header card-header-tabs-basic nav" role="tablist">
                        <a href="#active" class="active" data-toggle="tab" role="tab" aria-controls="activity_all"
                            aria-selected="true">Active</a>
                        <a href="#deactive" data-toggle="tab" role="tab" aria-selected="false"
                            class="">Deactive</a>
                        <a href="#trashed" data-toggle="tab" role="tab" aria-selected="false" class="">Trash</a>
                    </div>
                    <div class="card-body tab-content">
                        <div class="tab-pane fade active show" id="active">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Count</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $categorie)
                                        <tr>
                                            <td>{{ $categorie->id }}</td>
                                            <td>
                                                <img src="{{ asset('storage/category/' . $categorie->image) }}"
                                                    width="60" alt="">
                                            </td>
                                            <td>{{ $categorie->name }}</td>
                                            <td>{{ $categorie->slug }}</td>
                                            <td>0</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-primary">Edit</a>
                                                <a href="#" class="btn btn-sm btn-info">View</a>
                                                <form class="d-inline"
                                                    action="{{ route('backend.product.category.delete', $categorie->id) }}"
                                                    method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="mt-3 border-top pt-2">
                                {{ $categories->links() }}
                            </div>
                        </div>
                        <div class="tab-pane fade " id="deactive">
                            Deactive
                        </div>
                        <div class="tab-pane fade " id="trashed">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Count</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($trashcategories as $categorie)
                                        <tr>
                                            <td>{{ $categorie->id }}</td>
                                            <td>
                                                <img src="{{ asset('storage/category/' . $categorie->image) }}"
                                                    width="60" alt="">
                                            </td>
                                            <td>{{ $categorie->name }}</td>
                                            <td>{{ $categorie->slug }}</td>
                                            <td>0</td>
                                            <td>
                                                <a href="{{ route('backend.product.category.restore', $categorie->id) }}"
                                                    class="btn btn-sm btn-primary">Restore</a>
                                                <form
                                                    action="{{ route('backend.product.category.permanate.destroy', $categorie->id) }}"
                                                    class="d-inline" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="button"
                                                        class="btn btn-sm btn-danger permanate_delete">Permanate
                                                        Delete</button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="mt-3 border-top pt-2">
                                {{ $trashcategories->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-form__body card-body">
                        <form action="{{ route('backend.product.category.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Name:</label>
                                <input type="text" class="form-control" name="name" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label>Parent:</label>
                                <select name="parent" id="" class="form-control select_2">
                                    <option disabled selected>Select Parent</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Description:</label>
                                <textarea name="description" class="form-control" placeholder="Description" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Image:</label>
                                <input type="file" class="form-control" name="image">
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.15/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.15/sweetalert2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    @if (Session::has('success'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: "{{ Session::get('success') }}",
                showConfirmButton: false,
                timer: 5000
            })
        </script>
    @endif


    <script>
        $(document).ready(function() {
            $('.select_2').select2();

            $('.permanate_delete').on('click', function() {

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).parent('form').submit();
                    }
                })
            })



        });
    </script>

@endsection
