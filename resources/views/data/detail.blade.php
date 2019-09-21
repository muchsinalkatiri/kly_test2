@extends('layouts.app2')

@section('content')

<link href="{{url('sbadmin/vendor/datetimepicker/css/bootstrap-datetimepicker.css')}}" rel="stylesheet">

<div class="d-sm-flex align-items-center justify-content-between ">
</div>
<div class="card shadow mb-4">
	<div class="card-header">
		Detail Data
	</div>
	<div class="card-body">
		<form >
			{{ csrf_field() }}
			<div class="row">
				<div class="col-sm-8">
					<table class="table">
						<tr>
							<td><strong>Nama</strong></td>
							<td>{{ $nama }}</td>
						</tr>
						<tr>
							<td><strong>Email</strong></td>
							<td>{{ $email }}</td>
						</tr>
						<tr>
							<td><strong>Tanggal Lahir</strong></td>
							<td>{{ $tanggallahir }}</td>
						</tr>
						<tr>
							<td><strong>No Tlp</strong></td>
							<td>{{ $notlp }}</td>
						</tr>
						<tr>
							<td><strong>Gender</strong></td>
							<td>{{ $gender }}</td>
						</tr>
						<tr>
							<td><strong>Dibuat Tanggal</strong></td>
							<td>{{ $created_at }}</td>
						</tr>
						<tr>
							<td><strong>Terakhir Update</strong></td>
							<td>{{ $updated_at }}</td>
						</tr>
					</table>
				</div>
				<div class="col-sm-4 ">
					<center>
						<h2 >Foto</h2>
						<img class="card shadow mb-7" id="gambar_nodin"  alt="Preview Gambar" style='width:300px;height:300px; border-radius: 50%;  ' src="{{url('uploads/image/'.$foto) }}"> 
					</center>
				</div>
			</div>
		</form>
	</div>


	@endsection	


