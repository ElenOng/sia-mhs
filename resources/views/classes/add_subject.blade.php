@extends('layouts.layout')
@section('content')
<div class="breadcrumbs">
	<div class="col-sm-6">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Mata Pelajaran kelas {{ $classes->class_name }}</h1>
			</div>
		</div>
	</div>
</div>
<div class="content mt-3">
	<div class="animated fadeIn">
		<div class="col-12">
			<a href="{{ url('/classes') }}" class="btn btn-sm btn-danger"><i class="fa fa-1x fa-arrow-circle-left"></i> Kembali</a>
		</div>
	</div>
</div>
<div class="content mt-3">
	<div class="animated fadeIn">
		<div class="row" style="{{ $classes->status == 'Tidak Aktif' ? "display:none" : "" }}">
			<div class="col-12">
                <div class="card">
                    <div class="card-body card-block">
						<form action="{{ url('/classes/subject/store') }}" method="post">
						@csrf
						<input type="hidden" name="classes_id" value="{{ $classes->id }}">
						<div class="row form-group">
							<div class="col col-lg-4">Nama Mata Pelajaran</div>
							<div class="col col-lg-4">Nama Guru</div>
						</div>
						<div class="row form-group">
							<div class="col col-lg-4">
								<select name="subjects_id" id="" class="form-control">
									<option value="">Pilih Mata Pelajaran</option>
									@foreach($subjects as $sub)
										<option value="{{ $sub->id }}">{{ $sub->subject_name }}</option>
									@endforeach
								</select>
							</div>
							<div class="col col-lg-4">
								<select name="teachers_id" id="" class="form-control">
									<option value="">Pilih Guru</option>
									@foreach($teachers as $teac)
										<option value="{{ $teac->id }}">{{ $teac->teacher_name }}</option>
									@endforeach
								</select>
							</div>
							<div class="col col-lg-4">
								
								<button class="btn btn-sm btn-primary"><i class="fa fa-1x fa-plus"></i> Tambah</button>
							</div>
						</div>
						</form>
					</div>
                </div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				@if (session('invalids'))
					<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
						<ul>
							<li>{{ session('invalids') }}</li>
						</ul>
					</div>
				@endif
				@if ($errors->any())
					<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
			</div>
		</div>
		<div class="row">
			<div class="col-12">
                <div class="card">
                    <div class="card-body card-block">
						<div class="col-md-12">
							<table id="bootstrap-data-table" class="table table-striped table-bordered">
								<thead>
								<tr>
									<th>Mata Pelajaran</th>
									<th>Guru Pengajar</th>
									<th>Aksi</th>
								</tr>
								</thead>
								<tbody>
									@if(count($response)<1)
										<tr>
											<td colspan="3">Belum ada Mata Pelajaran dalam Kelas ini.</td>
										</tr>
									@else
									@foreach($response as $res)
									<form action="{{ route('class-subject-delete',$res->id) }}" method="post">
										@method('DELETE')
										@csrf
										<tr>
											<td>{{ $res->subject->subject_name }}</td>
											<td>{{ $res->teacher->teacher_name }}</td>
											<td>
												<button type="submit" onclick="return confirm('Apakah anda ingin menghapus Mata Pelajaran dari kelas ini?')" class="btn btn-sm btn-danger"><i class="fa fa-1x fa-trash"></i></button>
											</td>
										</tr>
									</form>
									@endforeach
									@endif
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
