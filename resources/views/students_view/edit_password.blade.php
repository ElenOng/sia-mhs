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
							<h1>Ubah Kata Sandi</h1>
						</div>
					</div>
				</div>
			</div>
        </div>
		<div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <br>
                        @endif
                        @if (session('error'))
                            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                <ul>
                                    <li>{{ session('error') }}</li>
                                </ul>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                                <ul>
                                    <li>{{ session('success') }}</li>
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('changePWD') }}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">
                        <input type="hidden" name="students_id" value="{{ $students_id }}">
                        <div class="row form-group">
                            <div class="co col-md-3">Kata Sandi Lama</div>
                            <div class="col-12 col-md-9">
                                <input type="password" name="old_pass" class="form-control" placeholder="Kata Sandi Lama">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="co col-md-3">Kata Sandi Baru</div>
                            <div class="col-12 col-md-9">
                                <input type="password" name="new_pass" class="form-control" placeholder="Kata Sandi Baru">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="co col-md-3">Konfirmasi Kata Sandi</div>
                            <div class="col-12 col-md-9">
                                <input type="password" name="conf_pass" class="form-control" placeholder="Konfirmasi Kata Sandi">
                            </div>
                        </div>
                        <div class="row form-group float-right">
                            <div class="col-12">
                                    <button class="btn btn-sm btn-primary">Simpan</button>
                                    <a href="{{ route('profile-student', $students_id) }}" class="btn btn-sm btn-danger">Batal</a>
                                </div>
                            </div>
                        </form>
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
