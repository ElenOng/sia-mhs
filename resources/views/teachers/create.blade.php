@extends('layouts.layout')
@section('content')
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Tambah Guru</h1>
			</div>
		</div>
	</div>
</div>
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body card-block">
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
                        <form action="{{ url('/teachers/store') }}" method="post" class="form-horizontal">
                            @csrf
                            <div class="row form-group">
                                <div class="col col-md-3">NIP</div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="employee_number" placeholder="NIP" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">Nama</div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="teacher_name" placeholder="Nama" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="co col-md-3">Jenis Kelamin</div>
                                <div class="col-12 col-md-9">
                                    <select name="gender" class="form-control">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="co col-md-3">Tanggal Lahir</div>
                                <div class="col-12 col-md-9">
                                    <input type="date" name="birth_date" max="{{ Date('Y-m-d') }}" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="co col-md-3">Gelar</div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="degree" placeholder="Gelar" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group float-right">
                                <div class="col">
                                    <button class="btn btn-sm btn-primary">Simpan</button>
                                    <a href="{{ url('/teachers') }}" class="btn btn-sm btn-danger">Batal</a>
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