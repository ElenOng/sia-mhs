@extends('layouts.layout_student')
@section('content')
<div class="container">
<div id="right-panel" class="right-panel">
	<header id="header" class="header">
		<div class="header-menu">
			<div class="col-sm-3">
				<a href="#">
					<img class="align-content" src="{{ asset('suffer-admin/images/logo_sia.png') }}" alt="Foto" width="60%" height="60%">
				</a>
			</div>
			<div class="col-sm-6 text-center">
				<h2 class="pb-2 display-5">Sistem Informasi Akademik</h2>
				<h5 class="pb-2 display-5">SMK Multistudi High School Batam</h5>
			</div>
			<div class="col-sm-3 text-right">
				<a class="btn btn-sm btn-link" href="{{ url('/logout') }}" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-1x fa-sign-out"></i> Keluar</a>
			</div>
		</div>
	</header>
	<div class="container">
		<div class="breadcrumbs">
			<div class="row">
				<div class="col-sm-6">
					<div class="page-header float-left">
						<div class="page-title">
							<h1>Selamat Datang {{ $student->name }}</h1>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="page-header float-right">
						<div class="page-title">
							<a href="{{ route('profile-student', $student->id) }}" class="btn btn-sm btn-link">
								<h1><i class="fa fa-1x fa-user"></i> Lihat Profil</h1>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<div class="row">
							@foreach($classes as $class)
							<div class="col-md-4">
								<div class="card">
									<div class="card-header">
										{{ $class->class_name }} Semester {{ $class->semester }}
									</div>
									<div class="card-body">
										<h5 class="text-sm-center mt-2 mb-1">Status Kelas</h5>
										@if($class->status == "Aktif")
										<h6 class="text-sm-center mt-2 mb-1"><span class="badge badge-success">{{ $class->status }}</span></h6>
										@else
										<h6 class="text-sm-center mt-2 mb-1"><span class="badge badge-danger">{{ $class->status }}</span></h6>
										@endif
									</div>
									<div class="card-footer">
										<form action="{{ route('class-detail', [$student->id, $class->id]) }}" method="post">
											@csrf
											<div class="card-text text-sm-center">
												<input type="hidden" name="subjects_id" value="">
												<button class="btn btn-sm btn-primary">Lihat Nilai Kelas</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('footer')
<footer class="footer">
	<div class="container">
		<p class="text-muted">&copy; 2019 Universitas Atma Jogja Fakultas Teknologi Industri Program Studi Teknik Informatika Elen 15 07 08131 </p>
	</div>
</footer>
@endsection
