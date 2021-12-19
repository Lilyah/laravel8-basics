@extends('admin.admin_master')

@section('admin')


			<div class="card-body">
                <form action="{{ route('store.contact') }}" method="POST">
                    @csrf

					@if(session('failure'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session('failure') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

					<div class="form-group">
						<label for="">Contact Email</label>
						<input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" >
						<!-- Displaying errors if there is any -->
						@error('email')
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
						<label for="">Contact Phone</label>
						<input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" >
						<!-- Displaying errors if there is any -->
						@error('phone')
                        <span class="text-danger">{{ $message }}</span>
                        <br>
                        @enderror
					</div>

					<div class="form-group">
						<label for="">Contact Address</label>
						<textarea class="form-control" id="" name="address" rows="3">{{ old('address') }}</textarea>
						<!-- Displaying errors if there is any -->
						@error('address')
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