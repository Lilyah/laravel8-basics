<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <!-- Displaying logedin username -->
            Edit Category
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <div class="row">
 
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                Edit Category
                            </div>
                            <div class="card-body">
                                <form action="{{ url('category/update/'.$categories->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Update Category Name</label>
                                        <input type="text" name="category_name" value="{{ $categories->category_name }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        <!-- Displaying errors if there is any -->
                                        @error('category_name')
                                            <span class="text-danger">{{ $message }}</span>
                                            <br>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Category</button>
                                </form>
                            </div><!-- .card-body -->
                        </div><!-- .card -->
                    </div><!-- .col-md-4 -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .max-w-7xl mx-auto sm:px-6 lg:px-8 -->
    </div>
</x-app-layout>
