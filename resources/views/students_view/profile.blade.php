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
							<h1>Profil</h1>
						</div>
					</div>
				</div>
			</div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="animated fadeIn">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                        <tbody>
                                            @foreach ($request as $req)
                                                <tr>
                                                    <th>NISN</th>
                                                    <td>{{ $req->student_number }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Nama</th>
                                                    <td>{{ $req->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Jenis Kelamin</th>
                                                    <td>{{ $req->gender }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tanggal Lahir</th>
                                                    <td>{{ $req->birth_date }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tempat Lahir</th>
                                                    <td>{{ $req->birth_place }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Agama</th>
                                                    <td>{{ $req->religion }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Alamat</th>
                                                    <td>{{ $req->address }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Sekolah Asal</th>
                                                    <td>{{ $req->ex_school }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Alamat Sekolah Asal</th>
                                                    <td>{{ $req->ex_school_address }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tahun Diterima</th>
                                                    <td>{{ $req->date_received }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Nama Ayah</th>
                                                    <td>{{ $req->father_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Nama Ibu</th>
                                                    <td>{{ $req->mother_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Telp/HP Orang Tua</th>
                                                    <td>{{ $req->parents_phone }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Alamat Orang Tua</th>
                                                    <td>{{ $req->parents_address }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Nama Wali</th>
                                                    <td>{{ $req->guardian_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Alamat Wali</th>
                                                    <td>{{ $req->guardian_address }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Telp/HP Wali</th>
                                                    <td>{{ $req->guardian_phone }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Jurusan</th>
                                                    <td>{{ $req->departments->department_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Status</th>
                                                    <td>
                                                        @foreach ($req->users as $user)
                                                            @if ($user->userstable_id == $req->id)
                                                                {{ $user->statuses->detail }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <a href="{{ route('home-student') }}" class="btn btn-sm btn-danger">Kembali</a>
                                    <a href="{{ route('profile-edit', $req->id) }}" class="btn btn-sm btn-success">Ubah Data</a>
                                    <a href="{{ route('changePassword', $req->id) }}" class="btn btn-sm btn-info">Ubah Kata Sandi</a>
                                </div>
                            </div>
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
