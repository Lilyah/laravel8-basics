@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <div class="row">


                    <div class="col-md-12">
                        <a href="{{ route('add.slider') }}">
                            <button class="btn btn-info mb-3">Add Slider</button>
                        </a>
                    </div>

                    <div class="col-md-12">
                        <div class="card">

                            <div class="card-header">
                                All Slider
                            </div>

                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col" width="5%">ID</th>
                                    <th scope="col" width="20%">Slider Title</th>
                                    <th scope="col" width="25%">Slider Description</th>
                                    <th scope="col" width="15%">Slider Image</th>
                                    <th scope="col" width="10%">Updated At</th>
                                    <th scope="col" width="10%">Created At</th>
                                    <th scope="col" width="15%">Action</th>
                                  </tr>
                                </thead>
                                <tbody>

                                    @foreach($sliders as $slider)

                                        <tr>
                                          <th scope="row">{{ $slider->id }}</th>
                                          <td>{{ $slider->title }}</td>
                                          <td>{{ $slider->description }}</td>
                                          <td>
                                              <img src="{{ asset($slider->image) }}" style="height:60px;" alt="">
                                          </td> 
                                          <td>{{ $slider->updated_at }}</td>
                                          <td>{{ $slider->created_at }}</td>
                                          <td>
                                              <a href="{{ url('admin/slider/edit/'.$slider->id) }}" class="btn btn-info" style="color:white">Edit</a>
                                              <a href="{{ url('admin/slider/delete/'.$slider->id)  }}" onclick="return confirm('Are you sure you want to delete this Slider?')" class="btn btn-danger">Delete</a>
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
                                        <td>{{ $sliders->links() }}</td>
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