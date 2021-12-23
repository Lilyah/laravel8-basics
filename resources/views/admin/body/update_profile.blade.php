@extends('admin.admin_master')

@section('admin')

<div class="card card-default">

    <!-- Displaying success messages after some action in the page -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif 

    @if(session('failure'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session('failure') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif 

	<div class="card-header card-header-border-bottom">
		<h2>Update Profile</h2>
	</div>
	<div class="card-body">
		<form method="post" action="{{ route('update.user.profile') }}" class="form-pill" enctype="multipart/form-data">
            @csrf

            <div class="input-group mb-3 d-flex justify-content-center">
                <br>
                <img src="{{ Auth::user()->profile_photo_url }}" class="img-circle mb-2" alt="User Image" style="width:60px;"/>
                <br>
                <div class="box">
                    <br>
                    <input type="hidden" name="old_image" value="{{ Auth::user()->profile_photo_url }}">
				    <input type="file" class="form-control-file ml-3" name="image" value="{{ $user['profile_photo_url'] }}">
                </div>
			</div>
            <div class="form-group">
				<label for="exampleFormControlPassword3">User Name</label>
				<input type="text" class="form-control" name="name" value="{{ $user['name'] }}">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror
            </div>
            <div class="form-group">
				<label for="exampleFormControlPassword3">User Email</label>
				<input type="email" class="form-control" name="email" value="{{ $user['email'] }}">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-defaul">Update</button>
		</form>
	</div>
</div>

@endsection