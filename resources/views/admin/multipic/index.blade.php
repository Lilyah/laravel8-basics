@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">

                            <div class="card-header">
                                All Images For Home Portfolio 
                            </div>

                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Filter</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Updated At</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>
                                <tbody>

                                    @foreach($images as $multi)

                                        <tr>
                                          <th scope="row">{{ $multi->id }}</th>
                                          <td>
                                              <img src="{{ asset($multi->image) }}" style="height:60px;" alt="">
                                          </td> 
                                          <td>{{ $multi->title }}</td>
                                          <td>{{ $multi->filter }}</td>
                                          <td>{{ $multi->created_at }}</td>
                                          <td>{{ $multi->updated_at }}</td>
                                          <td>
                                              <a href="{{ url('admin/multi/edit/'.$multi->id)  }}" class="btn btn-info" style="color:white">Edit</a>
                                              <a href="{{ url('admin/multi/delete/'.$multi->id)  }}" onclick="return confirm('Are you sure you want to delete this Image?')" class="btn btn-danger">Delete</a>
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
                                        <td>{{ $images->links() }}</td>
                                    </tr>

                                </tbody>
                            </table>                          
                        </div><!-- .card -->
                    </div><!-- .col-md-8 -->

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                Add Images
                            </div>
                            <div class="card-body">
                                <form action="{{ route('store.image') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Multi Image</label>
                                        <input type="file" name="image[]" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" multiple=""> <!-- 'multiple' allow us to select multiple images at once for upload -->
                                        <!-- Displaying errors if there is any -->
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                            <br>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">Add Image</button>
                                </form>
                            </div><!-- .card-body -->
                        </div><!-- .card -->
                    </div><!-- .col-md-4 -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .max-w-7xl mx-auto sm:px-6 lg:px-8 -->
    </div>

@endsection