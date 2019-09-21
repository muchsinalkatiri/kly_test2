@extends('layouts.app2')

@section('content')
<?php if(Session::has('success')): ?>
	<?php echo Session::get('success') ?>
<?php endif; ?>
<div class="d-sm-flex align-items-center justify-content-between ">
	<h1 class="h3 mb-3 text-gray-800">List Account</h1>
<a href="data/create/" class="d-none d-sm-inline-block btn btn-sm bg-gray-900 text-gray-100 shadow-sm" ><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a>
</div>
<div class="card shadow mb-4">
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered nowrap" id="dataTable"  cellspacing="0">
				<tr>
					<th>Nama File</th>
					<th>Tanggal dibuat</th>
					<th>Terakhir diupdate</th>
					<th>Opsi</th>
				</tr>
				@foreach($data as $d)
				<tr>
					<td>{{ $d->nama_file }}</td>
					<td>{{ $d->created_at }}</td>
					<td>{{ $d->updated_at }}</td>
					<td>
						<center>
							<a href="data/detail/{{$d->nama_file}} " class="btn btn-success btn-circle"  ><i class="fa fa-info"></i></a>
							<a href="data/update/{{$d->nama_file}} " class="btn btn-primary btn-circle"  ><i class="fa fa-edit"></i></a>
							<a href="data/delete/{{$d->nama_file}}" class="btn btn-danger btn-circle" " ><i class="fa fa-trash"></i></a>
						</center>
					</td>
				</tr>
				
				@endforeach
			</table>
		</div>
	</div>
</div>

@endsection

@section('footer_scripts')
<script type="text/javascript">
	$('#notifications').slideDown('slow').delay(3000).slideUp('slow');
</script>
@stop

