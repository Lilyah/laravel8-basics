@extends('admin.admin_master')

@section('admin')


			<div class="card-body">
                <form action="{{ route('store.about') }}" method="POST">
                    @csrf

					<div class="form-group">
						<label for="">About Title</label>
						<input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" >
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
								<input type="radio" id="visabilityActive" value="active" name="visability"/> 
								<div class="control-indicator"></div>
							</label>

							<label class="control control-radio" for="visabilityInactive">Inactive
								<input type="radio" id="visabilityInactive" value="inactive" name="visability"/> 
								<div class="control-indicator"></div>
							</label>

							<!-- Displaying errors if there is any -->
							@error('visability')
                        	<span class="text-danger">{{ $message }}</span>
                        	<br>
                        	@enderror
						</div>

					</div>

					<div class="form-group">
						<label for="">About Short Description</label>
						<textarea class="form-control" id="" name="short_desc" rows="3">{{ old('short_desc') }}</textarea>
						<!-- Displaying errors if there is any -->
						@error('short_desc')
                        <span class="text-danger">{{ $message }}</span>
                        <br>
                        @enderror
					</div>

					<div class="form-group">
						<label for="">About Long Description</label>
						<textarea class="form-control" id="" name="long_desc" rows="3">{{ old('long_desc') }}</textarea>
						<!-- Displaying errors if there is any -->
						@error('long_desc')
                        <span class="text-danger">{{ $message }}</span>
                        <br>
                        @enderror
					</div>

					<div class="form-footer pt-4 pt-5 mt-4 border-top">
						<button type="submit" class="btn btn-primary btn-default">Submit</button>
					</div>

				</form>
			</div>
		</div>
	</div>


@endsection