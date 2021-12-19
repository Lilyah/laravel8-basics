@extends('admin.admin_master')

@section('admin')


    <div class="col-lg-12">
		<div class="card card-default">
			<div class="card-header card-header-border-bottom">
				<h2>Edit Service for Homepage</h2>
			</div>
			<div class="card-body">
                <form action="{{ url('admin/services/update/'.$services->id) }}" method="POST">
                    @csrf
                    <div class="form-group row ml-1">
						<label for="">Position:&nbsp;</label>
						<p id="" name="position">{{ $services->position }}</p>
					</div>

					<div class="form-group">
						<label for="">Service Title</label>
						<input type="text" class="form-control" id="" name="title" value="{{ $services->title }}">
						<!-- Displaying errors if there is any -->
						@error('title')
                        <span class="text-danger">{{ $message }}</span>
                        <br>
                        @enderror
					</div>

					<div class="form-group">
						<label for="">Service Description</label>
						<textarea class="form-control" id="" name="desc" rows="3">{{ $services->desc }}</textarea>
						<!-- Displaying errors if there is any -->
						@error('short_desc')
                        <span class="text-danger">{{ $message }}</span>
                        <br>
                        @enderror
					</div>

					<div class="form-footer pt-4 pt-5 mt-4 border-top">
						<button type="submit" class="btn btn-primary btn-default">Update</button>
					</div>

				</form>
			</div>
		</div>
	</div>


@endsection