@extends('layouts.app2')

@section('content')

<link href="{{url('sbadmin/vendor/datetimepicker/css/bootstrap-datetimepicker.css')}}" rel="stylesheet">

<div class="d-sm-flex align-items-center justify-content-between ">
</div>
<div class="card shadow mb-4">
	<div class="card-header">
		Create Account
	</div>
	<div class="card-body">
		<form class="user" action="{{ action('DataController@create_proses') }}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="row">
				<div class="col-sm-8">
					<div class="form-group row">
						<div class="col-sm-6 mb-3 mb-sm-0">
							<div style="padding-left: 15px; " class="text-xs font-weight-bold text-danger text-uppercase mb-1"><?php echo $errors->first('nama') ?></div>
							<input required type="text" class="form-control form-control-user" value="{{ old('nama') }}" id="nama" placeholder="Nama" name="nama">
						</div>
						<div class="col-sm-6">
							<div style="padding-left: 15px; " class="text-xs font-weight-bold text-danger text-uppercase mb-1"><?php echo $errors->first('email') ?></div>
							<input required type="email" class="form-control form-control-user" value="{{ old('email') }}" id="email" name="email" placeholder="Email">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-6 mb-3 mb-sm-0">
							<div style="padding-left: 15px; " class="text-xs font-weight-bold text-danger text-uppercase mb-1"><?php echo $errors->first('tanggallahir') ?></div>
							<input required type="text" class="time form-control form-control-user "  id="tanggallahir" value="{{ old('tanggallahir') }}" name="tanggallahir" placeholder="Tanggal Lahir (YYYY-mm-dd)">
						</div>
						<div class="col-sm-6" >
							<div style="padding-left: 15px; " class="text-xs font-weight-bold text-danger text-uppercase mb-1"><?php echo $errors->first('notlp') ?></div>
							<input required type="text"  name="notlp" id="notlp" value="{{ old('notlp') }}" class="form-control-user form-control"  placeholder="No tlp" />
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-6 mb-3 mb-sm-0">
							<select required style="font-size: 0.8rem; height: 50px;  border-radius: 10rem; " class="form-control" name="gender">
								<option value="" disabled selected>Gender</option>
								<option value="male">male</option>
								<option value="Female">Female</option>
							</select>
						</div>
						<div class="col-sm-6 ">
							<div style="padding-left: 15px; " class="text-xs font-weight-bold text-danger text-uppercase mb-1"><?php echo $errors->first('foto') ?></div>
							<a style="text-decoration: none;" id="btnFile" class="text-gray-600 form-control form-control-user" href="#" onclick="return false;" >Foto</a>
							<input style="display: none; "  type="file"  name="foto" id="inputFile"  class=" form-control form-control-user"  />
						</div>
					</div>
					<hr>
					<div class="form-group row">
						<div class="col-sm-6 mb-3 mb-sm-0">
							<button type="submit" class="btn bg-gray-900 text-gray-100 btn-user btn-block">
								Tambahkan
							</button>
						</div>
						<div class="col-sm-6 ">
							<button type="reset" class="btn bg-danger text-gray-100 btn-user btn-block" onclick="pictureChange()">
								Reset
							</button>
						</div>
					</div>
				</div>
				<div class="col-sm-4 ">
					<center>
						<h2 >Foto</h2>
						<img class="card shadow mb-7" id="gambar_nodin"  alt="Preview Gambar" style='width:300px;height:300px; border-radius: 50%;  ' src="{{url('uploads/image/default.png')}}"> 
						<h7>Max Size 1 mb</h7>
					</center>
				</div>
			</div>
		</form>
	</div>
</div>


@endsection	
@section('footer_scripts')
<script src="{{url('sbadmin/vendor/datetimepicker/js/bootstrap-datetimepicker.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$('.time').datetimepicker({pickTime: false, format: 'yyyy-mm-dd', todayBtn: true,
			autoclose: true,
			pickTime: false,
			pickerPosition: "top-left"});
	});
</script>
<script type="text/javascript">
	function bacaGambar(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#gambar_nodin').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#inputFile").change(function(){
		bacaGambar(this);
	});
	$(document).ready(function(e) {
		$('#btnFile').click(function(){
			$('#inputFile').click();
		});

	});

	function pictureChange()
	{
		document.getElementById('gambar_nodin').src="{{url('uploads/image/default.png')}}";
	}


</script>
@stop

