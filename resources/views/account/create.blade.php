@extends('layouts.app2')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between ">
</div>
<div class="card shadow mb-4">
	<div class="card-header">
		Create Account
	</div>
	<div class="card-body">
		<form class="user" action="{{ action('AccountController@create_proses') }}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group row">
						<div style="padding-left: 15px; " class="text-xs font-weight-bold text-danger text-uppercase mb-1"><?php echo $errors->first('name') ?></div>
						<input type="text" class="form-control form-control-user mb-1" required  id="name" placeholder="Name" name="name" value="{{ old('name') }}">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group row">
						<div style="padding-left: 15px; " class="text-xs font-weight-bold text-danger text-uppercase mb-1"><?php echo $errors->first('email') ?></div>
						<input type="email" class="form-control form-control-user mb-1" required  id="email" placeholder="Email" name="email" value="{{ old('email') }}">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group row">
						<div style="padding-left: 15px; " class="text-xs font-weight-bold text-danger text-uppercase mb-1"><?php echo $errors->first('password') ?> </div>
						<input type="password" class="form-control form-control-user mb-1"  id="password" required placeholder="Password" name="password">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group row">
						<div style="padding-left: 15px; " class="text-xs font-weight-bold text-danger text-uppercase mb-1"><?php echo $errors->first('confirm_password') ?></div>
						<input type="password" class="form-control form-control-user mb-1"  id="confirm_password" placeholder="Confirm Password" name="confirm_password">
					</div>
				</div>

				<hr>
				<button type="submit" class="btn bg-gray-900 text-gray-100 btn-user btn-block">
					Tambahkan
				</button>		
			</div>
		</div>

	</form>
</div>
@endsection