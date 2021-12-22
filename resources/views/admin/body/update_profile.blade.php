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
		<form method="post" action="{{ route('update.user.profile') }}" class="form-pill">
            @csrf
            <div class="form-group">
				<label for="exampleFormControlPassword3">User Name</label>
				<input type="text" class="form-control" name="name" value="{{ $user['name'] }}">
            </div>
            <div class="form-group">
				<label for="exampleFormControlPassword3">User Email</label>
				<input type="email" class="form-control" name="email" value="{{ $user['email'] }}">
            </div>
            <button type="submit" class="btn btn-primary btn-defaul">Update</button>
		</form>
	</div>
</div>

@endsection