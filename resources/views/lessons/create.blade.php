@extends('layouts.layout')
@section('content')
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Tambah Mata Pelajaran</h1>
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
                        @if(session('validate'))
                        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                            <ul>
                                <li>{{ session('validate') }}</li>
                            </ul>
                        </div>
                        <br>
                        @endif
                        <form action="{{ url('/lessons/store') }}" method="post" class="form-horizontal">
                            @csrf
                            <div class="row form-group">
                                <div class="col col-md-3">Nama Mata Pelajaran</div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="subject_name" placeholder="Nama Mata Pelajaran" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">Alias</div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="alias" placeholder="Alias" class="form-control" style="text-transform: uppercase;">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">Jenis Mata Pelajaran</div>
                                <div class="col-12 col-md-9">
                                    <select name="subject_type" class="form-control">
                                        <option value="">Pilih Jenis Mata Pelajaran</option>
                                        <option value="Produktif">Produktif</option>
                                        <option value="Adaptif">Adaptif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">KKM</div>
                                <div class="col-12 col-md-9">
                                    <input type="number" name="min_value" class="form-control" min="0" max="100" placeholder="KKM">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">Jurusan</div>
                                <div class="col-12 col-md-9">
                                    <select name="departments_id" class="form-control">
                                        <option value="">Pilih Jurusan</option>
                                        @foreach($departments as $dept)
                                            <option value="{{ $dept->id }}">{{ $dept->department_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="status" value="Aktif">
                            <div class="row form-group float-right">
                                <div class="col">
                                    <button class="btn btn-sm btn-primary">Simpan</button>
                                    <a href="{{ url('/lessons') }}" class="btn btn-sm btn-danger">Batal</a>
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