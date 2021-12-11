@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">

                        <!-- Displaying success messages after some action in the page -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                            <div class="card-header">
                                All Brand
                            </div>


                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Brand Name</th>
                                    <th scope="col">Brand Image</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>
                                <tbody>

                                    @foreach($brands as $brand)

                                        <tr>
                                          <th scope="row">{{ $brand->id }}</th>
                                          <td>{{ $brand->brand_name }}</td>
                                          <td>
                                              <img src="{{ asset($brand->brand_image) }}" style="height:60px;" alt="">
                                          </td> 
                                          <td>{{ $brand->created_at }}</td>
                                          <td>
                                              <a href="{{ url('brand/edit/'.$brand->id) }}" class="btn btn-info" style="color:white">Edit</a>
                                              <a href="{{ url('brand/delete/'.$brand->id)  }}" onclick="return confirm('Are you sure you want to delete this Brand?')" class="btn btn-danger">Delete</a>
                                          </td>
                                        </tr>

                                    @endforeach

                                        <!-- Pagination -->
                                        <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{ $brands->links() }}</td>
                                    </tr>

                                </tbody>
                            </table>                          
                        </div><!-- .card -->
                    </div><!-- .col-md-8 -->

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                Add Brand
                            </div>
                            <div class="card-body">
                                <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Brand Name</label>
                                        <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        <!-- Displaying errors if there is any -->
                                        @error('brand_name')
                                            <span class="text-danger">{{ $message }}</span>
                                            <br>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Brand Image</label>
                                        <input type="file" name="brand_image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        <!-- Displaying errors if there is any -->
                                        @error('brand_image')
                                            <span class="text-danger">{{ $message }}</span>
                                            <br>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">Add Brand</button>
                                </form>
                            </div><!-- .card-body -->
                        </div><!-- .card -->
                    </div><!-- .col-md-4 -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .max-w-7xl mx-auto sm:px-6 lg:px-8 -->
    </div>

@endsection