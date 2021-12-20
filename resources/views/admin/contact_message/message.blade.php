@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <div class="row">

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
                                All Messages from Contact Form
                            </div>


                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col" width="5%">ID</th>
                                    <th scope="col" width="5%">Sender</th>
                                    <th scope="col" width="15%">Email</th>
                                    <th scope="col" width="25%">Subject</th>
                                    <th scope="col" width="25%">Message</th>
                                    <th scope="col" width="10%">Sended At</th>
                                    <th scope="col" width="15%">Action</th>
                                  </tr>
                                </thead>
                                <tbody>

                                    @foreach($messages as $message)

                                        <tr>
                                          <th scope="row">{{ $message->id }}</th>
                                          <td>{{ $message->name }}</td>
                                          <td>{{ $message->email }}</td>
                                          <td>{{ $message->subject }}</td>
                                          <td>{{ $message->message }}</td>
                                          <td>{{ $message->created_at }}</td>
                                          <td>
                                              <a href="" onclick="return confirm('Are you sure you want to delete this Message?')" class="btn btn-danger">Delete</a>
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
                                        <td>{{ $messages->links() }}</td>
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