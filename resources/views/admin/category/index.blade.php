<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Category
        </h2>
    </x-slot>

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
                                All Category
                            </div>


                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>
                                <tbody>

                                    @foreach($categories as $category)

                                        <tr>
                                          <th scope="row">{{ $category->id }}</th>
                                          <td>{{ $category->category_name }}</td>
                                          <td>{{ $category->user->name }}</td> <!-- This line is needed if you are using Eloquent ORM in Category model and CategoryController; Accessing column 'name' in table 'users' where user id's is equal. This is possible because we developed user() method in Category model -->
                                          <!--<td>{{-- $category->name --}}</td>--><!-- The above result, but with Quiery Builder, e.g. 'name' is the name of the user with the id from users table which is in categories -->
                                          <td>{{ $category->created_at }}</td>
                                          <td>
                                              <a href="{{ url('category/edit/'.$category->id) }}" class="btn btn-info" style="color:white">Edit</a>
                                              <a href="{{ url('softdelete/category/'.$category->id)  }}" class="btn btn-danger">Delete</a>
                                          </td>
                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            {{ $categories->links() }}
                            
                        </div><!-- .card -->
                    </div><!-- .col-md-8 -->

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                Add Category
                            </div>
                            <div class="card-body">
                                <form action="{{ route('store.category') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Category Name</label>
                                        <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        <!-- Displaying errors if there is any -->
                                        @error('category_name')
                                            <span class="text-danger">{{ $message }}</span>
                                            <br>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Category</button>
                                </form>
                            </div><!-- .card-body -->
                        </div><!-- .card -->
                    </div><!-- .col-md-4 -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .max-w-7xl mx-auto sm:px-6 lg:px-8 -->
    </div>







    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">

                            <div class="card-header">
                                Trash List
                            </div>


                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>
                                <tbody>

                                    @foreach($trashCat as $category)

                                        <tr>
                                          <th scope="row">{{ $category->id }}</th>
                                          <td>{{ $category->category_name }}</td>
                                          <td>{{ $category->user->name }}</td> <!-- This line is needed if you are using Eloquent ORM in Category model and CategoryController; Accessing column 'name' in table 'users' where user id's is equal. This is possible because we developed user() method in Category model -->
                                          <!--<td>{{-- $category->name --}}</td>--><!-- The above result, but with Quiery Builder, e.g. 'name' is the name of the user with the id from users table which is in categories -->
                                          <td>{{ $category->created_at }}</td>
                                          <td>
                                              <a href="{{ url('category/restore/'.$category->id) }}" class="btn btn-info" style="color:white">Restore</a>
                                              <a href="{{ url('pdelete/category/'.$category->id) }}" class="btn btn-danger">Permanent Delete</a>
                                          </td>
                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            {{ $trashCat->links() }}
                            
                        </div><!-- .card -->
                    </div><!-- .col-md-8 -->

                    <div class="col-md-4">
                    </div><!-- .col-md-4 -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .max-w-7xl mx-auto sm:px-6 lg:px-8 -->
    </div>
</x-app-layout>
