<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Multi Picture
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">

                        <!-- Displaying success messages after some action in the page -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        
                        <div class="card-group">

                            @foreach($images as $multi)
                                <div class="col-md-4 m-5">
                                    <div class="card">
                                        <img src="{{ asset($multi->image) }}" alt="">
                                    </div>
                                </div>
                            @endforeach
                            
                        </div><!-- .card-group -->
                    </div><!-- .col-md-8 -->

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                Multi Image
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


</x-app-layout>
