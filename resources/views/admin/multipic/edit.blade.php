@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <div class="row">
 
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Edit Image
                            </div>
                            <div class="card-body">
                                <form action="{{ url('multi/update/'.$multi->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="old_image" value="{{ $multi->image }}">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Update Title</label>
                                        <input type="text" name="title" value="{{ $multi->title }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        <!-- Displaying errors if there is any -->
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                            <br>
                                        @enderror
                                    </div>


                                    <div class="form-group row">

                                        <div class="col-12 text-left">
						                	<label for="filter">Filter for Home page SELECT</label>
						                </div>					
                                        
                                        <div class="col-12 col-md-3">

                                            <select class="form-control" id="filter" name="filter">
												<option value="All" name="filter"
						                		{{ ($multi->filter == 'All') ? 'selected' : '' }}> <!-- if the field in the db is 'all' then this button will be checked -->All</option>
												<option value="App" name="filter"
						                		{{ ($multi->filter == 'App') ? 'selected' : '' }}> <!-- if the field in the db is 'app' then this card will be checked -->App</option>
												<option value="Card" name="filter"
						                		{{ ($multi->filter == 'Card') ? 'selected' : '' }}> <!-- if the field in the db is 'card' then this button will be checked -->Card</option>
												<option value="Web" name="filter"
						                		{{ ($multi->filter == 'Web') ? 'selected' : '' }}> <!-- if the field in the db is 'web' then this button will be checked -->Web</option>
												<option value="" name="filter"
						                		{{ ($multi->filter == '') ? 'selected' : '' }}> <!-- if the field in the db is empty then this button will be checked -->Null</option>
											</select>

										</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Update Description</label>
                                        <textarea class="form-control" id="" name="description" rows="3">{{ $multi->description }}</textarea>
                                        <!-- Displaying errors if there is any -->
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                            <br>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Update Image</label>
                                        <input type="file" name="image" value="{{ $multi->image }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        <!-- Displaying errors if there is any -->
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                            <br>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <img src="{{ asset($multi->image) }}" style="height:150px;" alt="">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update Image</button>
                                </form>
                            </div><!-- .card-body -->
                        </div><!-- .card -->
                    </div><!-- .col-md-8 -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .max-w-7xl mx-auto sm:px-6 lg:px-8 -->
    </div>

@endsection