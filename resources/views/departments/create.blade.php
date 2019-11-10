@extends('layouts.layout')
@section('content')
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Tambah Jurusan</h1>
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
                        <form action="{{ url('/departments/store') }}" method="POST" class="form-horizontal">
                            @csrf
                            <div class="row form-group">
                                <div class="col col-md-3">Nama Jurusan</div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="department_name" placeholder="Nama Jurusan" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">Prefix / Singkatan</div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="prefix" placeholder="Nama Singkat" class="form-control" maxlength="3">
                                </div>
                            </div>
                            <input type="hidden" name="status" value="Aktif">
                            <div class="row form-group float-right">
                                <div class="col">
                                    <button class="btn btn-sm btn-primary">Simpan</button>
                                    <a href="{{ url('/departments') }}" class="btn btn-sm btn-danger">Batal</a>
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