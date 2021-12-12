@extends('admin.admin_master')

@section('admin')


    <div class="col-lg-12">
		<div class="card card-default">
			<div class="card-header card-header-border-bottom">
				<h2>Edit About for Homepage</h2>
			</div>
			<div class="card-body">
                <form action="{{ url('about/update/'.$homeabout->id) }}" method="POST">
                    @csrf
					<div class="form-group">
						<label for="">About Title</label>
						<input type="text" class="form-control" id="" name="title" value="{{ $homeabout->title }}">
						<!-- Displaying errors if there is any -->
						@error('title')
                        <span class="text-danger">{{ $message }}</span>
                        <br>
                        @enderror
					</div>

					<div class="form-group row">
						<div class="col-12 text-left">
							<label for="visability">Visability</label>
						</div>

						<div class="col-12 col-md-9">
							<label class="control control-radio" for="visabilityActive">Active
								<input type="radio" id="visabilityActive" value="active" name="visability"
								{{ ($homeabout->visability == 'active')? 'checked' : '' }}/> <!-- if the field in the db is 'active' then this button will be checked -->
								<div class="control-indicator"></div>
							</label>

							<label class="control control-radio" for="visabilityInactive">Inactive
								<input type="radio" id="visabilityInactive" value="inactive" name="visability"
								{{ ($homeabout->visability == 'inactive')? 'checked' : '' }}/> <!-- if the field in the db is 'inactive' then this button will be checked -->
								<div class="control-indicator"></div>
							</label>
						</div>

						<!-- Displaying errors if there is any -->
						@error('visability')
                        <span class="text-danger">{{ $message }}</span>
                        <br>
                        @enderror
					</div>

					<div class="form-group">
						<label for="">About Short Description</label>
						<textarea class="form-control" id="" name="short_desc" rows="3">{{ $homeabout->short_desc }}</textarea>
						<!-- Displaying errors if there is any -->
						@error('short_desc')
                        <span class="text-danger">{{ $message }}</span>
                        <br>
                        @enderror
					</div>

					<div class="form-group">
						<label for="">About Long Description</label>
						<textarea class="form-control" id="" name="long_desc" rows="3">{{ $homeabout->long_desc }}</textarea>
						<!-- Displaying errors if there is any -->
						@error('long_desc')
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