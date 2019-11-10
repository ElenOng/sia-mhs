@extends('layouts.layout')
@section('content')
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Ubah Data Jabatan {{ $request->role }}</h1>
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
                        <form action="{{ url('/roles/update', $request->id) }}" method="post" class="form-horizontal">
                            @csrf
                            <input name="_method" type="hidden" value="PATCH">
                            <div class="row form-group">
                                <div class="col col-md-3">Nama Jabatan</div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="role" placeholder="Nama Jabatan" class="form-control" value="{{ $request->role }}">
                                </div>
                            </div>
                            @if ($request->status == 'Tidak Aktif')
                                <div class="row form-group">
                                    <div class="col col-md-3">Status</div>
                                    <div class="col col-md-3">
                                        <select name="status" class="form-control" style="width: 150%">
                                            <option value="">Pilih</option>
                                            <option value="Aktif">Aktif</option>
                                            <option value="Tidak">Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>
                            @else
                                <input type="hidden" name="status" value="Aktif">
                            @endif
                            
                            <div class="row form-group float-right">
                                <div class="col">
                                    <button class="btn btn-sm btn-primary">Simpan</button>
                                    <a href="{{ url('/roles') }}" class="btn btn-sm btn-danger">Batal</a>
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