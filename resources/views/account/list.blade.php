@extends('layouts.app2')

@section('content')
<?php if(Session::has('register_success')): ?>
	<?php echo Session::get('register_success') ?>
<?php endif; ?>
<div class="d-sm-flex align-items-center justify-content-between ">
	<h1 class="h3 mb-3 text-gray-800">List Account</h1>
	<a href="account/create/" class="d-none d-sm-inline-block btn btn-sm bg-gray-900 text-gray-100 shadow-sm" ><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a>
</div>
<div class="card shadow mb-4">
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered nowrap" id="dataTable"  cellspacing="0">
				<tr>
					<th>Nama</th>
					<th>Email</th>
					<th>Tanggal dibuat</th>
					<th>Terakhir Update</th>
					<th>Opsi</th>
				</tr>
				@foreach($users as $u)
				<tr>
					<td>{{ $u->name }}</td>
					<td>{{ $u->email }}</td>
					<td>{{ $u->created_at }}</td>
					<td>{{ $u->updated_at }}</td>
					<td>
						<center>
							<a href="account/update/{{$u->id}} " class="btn btn-primary btn-circle"  ><i class="fa fa-edit"></i></a>
							<a href="account/delete/{{$u->id}}" class="btn btn-danger btn-circle" " ><i class="fa fa-trash"></i></a>
						</center>
					</td>
				</tr>
				
				@endforeach
			</table>
		</div>
	</div>
</div>
@endsection