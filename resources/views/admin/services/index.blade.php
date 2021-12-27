@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">

                            <div class="card-header">
                                All Abouts
                            </div>

                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col" width="5%">ID</th>
                                    <th scope="col" width="5%">Position</th>
                                    <th scope="col" width="15%">Service Title</th>
                                    <th scope="col" width="20%">Service Description</th>
                                    <th scope="col" width="10%">Updated At</th>
                                    <th scope="col" width="15%">Action</th>
                                  </tr>
                                </thead>
                                <tbody>

                                    @foreach($services as $service)

                                        <tr>
                                          <th scope="row">{{ $service->id }}</th>
                                          <td>{{ $service->position }}</td>
                                          <td>{{ $service->title }}</td>
                                          <td>{{ $service->desc }}</td>
                                          <td>{{ $service->updated_at }}</td>
                                          <td>
                                              <a href="{{ url('/admin/service/edit/'.$service->id) }}" class="btn btn-info" style="color:white">Edit</a>
                                          </td>
                                        </tr>

                                    @endforeach

                                </tbody>
                            </table>


                            
                        </div><!-- .card -->
                    </div><!-- .col-md-8 -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .max-w-7xl mx-auto sm:px-6 lg:px-8 -->
    </div>

@endsection