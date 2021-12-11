@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <div class="row">


                    <div class="col-md-12">
                        <a href="{{ route('add.about') }}">
                            <button class="btn btn-info mb-3">Add About</button>
                        </a>
                    </div>

                    <div class="col-md-12">
                        <div class="card">

                        <!-- Displaying success messages after some action in the page -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                            <div class="card-header">
                                All Abouts
                            </div>


                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col" width="5%">ID</th>
                                    <th scope="col" width="20%">About Title</th>
                                    <th scope="col" width="20%">Short Description</th>
                                    <th scope="col" width="20%">Long Description</th>
                                    <th scope="col" width="10%">Updated At</th>
                                    <th scope="col" width="10%">Created At</th>
                                    <th scope="col" width="15%">Action</th>
                                  </tr>
                                </thead>
                                <tbody>

                                    @foreach($homeabout as $about)

                                        <tr>
                                          <th scope="row">{{ $about->id }}</th>
                                          <td>{{ $about->title }}</td>
                                          <td>{{ $about->short_desc }}</td>
                                          <td>{{ $about->long_desc }}</td>
                                          <td>{{ $about->updated_at }}</td>
                                          <td>{{ $about->created_at }}</td>
                                          <td>
                                              <a href="{{ url('about/edit/'.$about->id) }}" class="btn btn-info" style="color:white">Edit</a>
                                              <a href="{{ url('about/delete/'.$about->id)  }}" onclick="return confirm('Are you sure you want to delete this About?')" class="btn btn-danger">Delete</a>
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
                                        <td>{{ $homeabout->links() }}</td>
                                    </tr>
                                    
                                </tbody>
                            </table>


                            
                        </div><!-- .card -->
                    </div><!-- .col-md-8 -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .max-w-7xl mx-auto sm:px-6 lg:px-8 -->
    </div>

@endsection