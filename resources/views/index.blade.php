@extends('layouts.layout')
@section('content')
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Beranda</h1>
			</div>
		</div>
	</div>
</div>
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row" style="{{ ($auth->roles_id)== 3 ? "" : "display: none" }}">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title mb-3">Siswa</strong>
                    </div>
                    <div class="card-body">
                        <div class="mx-auto d-block">
                            <h5 class="text-sm-center mt-2 mb-1">Jumlah Siswa Aktif</h5>
                            <h1 align="center">{{ $request['students'] }}</h1>
                        </div>
                        <hr>
                        <div class="card-text text-sm-center">
                            <a href="{{ url('/students') }}" class="btn btn-sm btn-primary">Lihat Data Siswa</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title mb-3">Guru</strong>
                    </div>
                    <div class="card-body">
                        <div class="mx-auto d-block">
                            <h5 class="text-sm-center mt-2 mb-1">Jumlah Guru Aktif</h5>
                            <h1 align="center">{{ $request['teachers'] }}</h1>
                        </div>
                        <hr>
                        <div class="card-text text-sm-center">
                            <a href="{{ url('/teachers') }}" class="btn btn-sm btn-primary">Lihat Data Guru</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title mb-3">Jurusan</strong>
                    </div>
                    <div class="card-body">
                        <div class="mx-auto d-block">
                            <h5 class="text-sm-center mt-2 mb-1">Jurusan yang tersedia</h5>
                            <h1 align="center">{{ $request['departments'] }}</h1>
                        </div>
                        <hr>
                        <div class="card-text text-sm-center">
                            <a href="{{ url('/departments') }}" class="btn btn-sm btn-primary">Lihat Data Jurusan</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title mb-3">Mata Pelajaran</strong>
                    </div>
                    <div class="card-body">
                        <div class="mx-auto d-block">
                            <h5 class="text-sm-center mt-2 mb-1">Mata Pelajaran yang tersedia</h5>
                            <h1 align="center">{{ $request['subjects'] }}</h1>
                        </div>
                        <hr>
                        <div class="card-text text-sm-center">
                            <a href="{{ url('/lessons') }}" class="btn btn-sm btn-primary">Lihat Data Mata Pelajaran</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="row" style="{{ ($auth->roles_id)== 2 ? "" : "display: none" }}">

        </div> -->
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
