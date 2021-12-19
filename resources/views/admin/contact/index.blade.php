@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <div class="row">


                    <div class="col-md-12">
                        <a href="{{ route('add.contact') }}">
                            <button class="btn btn-info mb-3">Add Contact Information</button>
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
                                All Contact Informations
                            </div>


                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col" width="5%">ID</th>
                                    <th scope="col" width="5%">Visability</th>
                                    <th scope="col" width="30%">Address</th>
                                    <th scope="col" width="25%">Phone</th>
                                    <th scope="col" width="10%">Updated At</th>
                                    <th scope="col" width="10%">Created At</th>
                                    <th scope="col" width="15%">Action</th>
                                  </tr>
                                </thead>
                                <tbody>

                                    @foreach($contacts as $contact)

                                        <tr>
                                          <th scope="row">{{ $contact->id }}</th>
                                          <td>{{ $contact->visability }}</td>
                                          <td>{{ $contact->address }}</td>
                                          <td>{{ $contact->phone }}</td>
                                          <td>{{ $contact->updated_at }}</td>
                                          <td>{{ $contact->created_at }}</td>
                                          <td>
                                              <a href="{{ url('admin/contact/edit/'.$contact->id) }}" class="btn btn-info" style="color:white">Edit</a>
                                              <a href="{{ url('admin/contact/delete/'.$contact->id) }}" onclick="return confirm('Are you sure you want to delete this Contact Information?')" class="btn btn-danger">Delete</a>
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
                                        <td>{{ $contacts->links() }}</td>
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