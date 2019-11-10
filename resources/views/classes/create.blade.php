@extends('layouts.layout')
@section('content')
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Tambah Kelas</h1>
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
                    @if (session('status'))
                        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                            <ul>
                               <li>{{ session('status') }}</li>
                            </ul>
                        </div>
                        <br>
                    @endif
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
                        <form action="{{ url('/classes/store') }}" method="post" class="form-horizontal">
                            @csrf
                            <div class="row form-group">
                                <div class="col col-md-3">Nomor Kelas</div>
                                <div class="col-12 col-md-9">
                                    <input type="number" name="class_number" placeholder="Nomor Kelas" class="form-control" min="1" max="8">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">Kelas</div>
                                <div class="col-12 col-md-9">
                                    <select name="grade" class="form-control">
                                        <option value="">Pilih Kelas</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">Semester</div>
                                <div class="col-12 col-md-9">
                                    <select name="semester" class="form-control">
                                        <option value="">Pilih Semester</option>
                                        <option value="Genap">Genap</option>
                                        <option value="Ganjil">Ganjil</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">Tahun Ajaran</div>
                                <div class="col-12 col-md-4">
                                    <input id="year-a" type="number" name="yearA" minlength="4" maxlength="4" min="2001" max="{{ date('Y') }}" placeholder="Tahun" class="form-control">
                                </div>
                                <div class="col-12 col-md-4">
                                    <input id="year-b" type="number" name="yearB"  minlength="4" maxlength="4" min="2001" max="{{ date('Y') }}" placeholder="Tahun" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">Jurusan</div>
                                <div class="col-12 col-md-9">
                                    <select name="departments_id" class="form-control">
                                        <option value="">Pilih Jurusan</option>
                                        @foreach ($request as $req)
                                            <option value="{{ $req->id }}">{{ $req->department_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">Wali Kelas</div>
                                <div class="col-12 col-md-9">
                                    <select name="teachers_id" class="form-control">
                                        <option value="">Pilih Wali Kelas</option>
                                        @foreach ($teachers as $req)
                                            <option value="{{ $req->id }}">{{ $req->teacher_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group float-right">
                                <div class="col">
                                    <button class="btn btn-sm btn-primary">Simpan</button>
                                    <a href="{{ url('/classes') }}" class="btn btn-sm btn-danger">Batal</a>
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
