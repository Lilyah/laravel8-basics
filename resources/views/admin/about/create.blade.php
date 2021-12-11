@extends('admin.admin_master')

@section('admin')


    <div class="col-lg-12">
		<div class="card card-default">
			<div class="card-header card-header-border-bottom">
				<h2>Create About for Homepage</h2>
			</div>
			<div class="card-body">
                <form action="{{ route('store.about') }}" method="POST">
                    @csrf
					<div class="form-group">
						<label for="">About Title</label>
						<input type="text" class="form-control" id="" name="title" placeholder="About Title">
					</div>

					<div class="form-group">
						<label for="">About Short Description</label>
						<textarea class="form-control" id="" name="short_desc" rows="3" placeholder="About Short Description"></textarea>
					</div>

					<div class="form-group">
						<label for="">About Long Description</label>
						<textarea class="form-control" id="" name="long_desc" rows="3" placeholder="About Long Description"></textarea>
					</div>

					<div class="form-footer pt-4 pt-5 mt-4 border-top">
						<button type="submit" class="btn btn-primary btn-default">Submit</button>
					</div>

				</form>
			</div>
		</div>
	</div>


@endsection