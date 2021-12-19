@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <div class="row">
 
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Edit Category
                            </div>
                            <div class="card-body">
                                <form action="{{ url('admin/brand/update/'.$brands->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="old_image" value="{{ $brands->brand_image }}">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Update Brand Name</label>
                                        <input type="text" name="brand_name" value="{{ $brands->brand_name }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        <!-- Displaying errors if there is any -->
                                        @error('brand_name')
                                            <span class="text-danger">{{ $message }}</span>
                                            <br>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Update Brand Image</label>
                                        <input type="file" name="brand_image" value="{{ $brands->brand_image }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        <!-- Displaying errors if there is any -->
                                        @error('brand_image')
                                            <span class="text-danger">{{ $message }}</span>
                                            <br>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <img src="{{ asset($brands->brand_image) }}" style="height:150px;" alt="">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update Brand</button>
                                </form>
                            </div><!-- .card-body -->
                        </div><!-- .card -->
                    </div><!-- .col-md-8 -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .max-w-7xl mx-auto sm:px-6 lg:px-8 -->
    </div>

@endsection