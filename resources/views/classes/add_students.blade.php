@extends('layouts.layout')
@section('content')
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Pilih Siswa</h1>
			</div>
		</div>
	</div>
</div>
<div class="content mt-3">
	<div class="animated fadeIn">
		<div class="row">
			<div class="col-sm-6">
					@if (session('errors'))
						<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
							<ul>
								<li>{{ session('errors') }}</li>
							</ul>
						</div>
					@endif
			</div>
		</div>
		<form action="{{ route('detail-store') }}" method="post">
		@csrf
		<input type="hidden" name="id" value="{{ $id }}">
		<div class="row">
			<div class="col-sm-6">
				<a href="{{ route('detail-classes',$id) }}" class="btn btn-sm btn-danger">Batal</a>
				<button type="submit" class="btn btn-sm btn-primary">Simpan</button>
			</div>
			<div class="col-md-12">		
				<table id="bootstrap-data-table" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama</th>
							<th>Jurusan</th>
							<th>Jenis Kelamin</th>
						</tr>
					</thead>
					<tbody>
						@if (count($request)<1)
							<tr>
								<td colspan="4">Tidak ada siswa yang tersedia</td>
							</tr>
						@else
							@foreach ($request as $req)
								<tr>
									<td><input type="checkbox" name="students[]" value="{{$req->id}}"></td>
									<td>{{ $req->name }}</td>
									<td>{{ $req->departments->department_name }}</td>
									<td>{{ $req->gender }}</td>
								</tr>
							@endforeach
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection
