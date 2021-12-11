@extends('admin.admin_master')

@section('admin')


    <div class="col-lg-12">
		<div class="card card-default">
			<div class="card-header card-header-border-bottom">
				<h2>Edit Slider</h2>
			</div>
			<div class="card-body">
                <form action="{{ url('slider/update/'.$sliders->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
					<div class="form-group">
						<label for="">Update Slider Title</label>
						<input type="text" class="form-control" id="" name="title" placeholder="Slidet Title" value="{{ $sliders->title }}">
					</div>

					<div class="form-group">
						<label for="">Update Slider Description</label>
						<textarea class="form-control" id="" name="description" rows="3">{{ $sliders->description }}</textarea>
					</div>

					<div class="form-group">
						<label for="">Update Slider Image</label>
                        <input type="hidden" name="old_image" value="{{ $sliders->image }}">
						<input type="file" class="form-control-file" id="" name="image" value="{{ $sliders->image }}">
                        <!-- Displaying errors if there is any -->
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror
					</div>

                    <div class="form-group">
                        <img src="{{ asset($sliders->image) }}" style="height:350px;" alt="">
                    </div>

					<div class="form-footer pt-4 pt-5 mt-4 border-top">
						<button type="submit" class="btn btn-primary btn-default">Update</button>
					</div>

				</form>
			</div>
		</div>
	</div>


@endsection