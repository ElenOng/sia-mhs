@extends('layouts.layout')
@section('content')
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Ubah Data Siswa</h1>
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
                        <form action="{{ url('/students/update', $request->id) }}" method="post" class="form-horizontal">
                            @csrf
                            <input name="_method" type="hidden" value="PATCH">
                            <div class="row form-group">
                                <div class="col col-md-3">NISN</div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="student_number" placeholder="NISN" class="form-control" value="{{ $request->student_number }}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">Nama</div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="name" placeholder="Nama" class="form-control" value="{{ $request->name }}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="co col-md-3">Jenis Kelamin</div>
                                <div class="col-12 col-md-9">
                                    <select name="gender" class="form-control">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        @if ($request->gender =='Laki-laki')
                                            <option value="Laki-laki" selected="true">Laki-laki</option>    
                                            <option value="Perempuan">perempuan</option>
                                        @else
                                            <option value="Laki-laki">Laki-laki</option>    
                                            <option value="Perempuan" selected="true">perempuan</option>
                                        @endif
                                        
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="co col-md-3">Tanggal Lahir</div>
                                <div class="col-12 col-md-9">
                                    <input type="date" name="birth_date" max="{{ Date('Y-m-d') }}" class="form-control" value="{{ $request->birth_date }}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="co col-md-3">Tempat Lahir</div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="birth_place" placeholder="Tempat Lahir" class="form-control" value="{{ $request->birth_place }}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="co col-md-3">Agama</div>
                                <div class="col-12 col-md-9">
                                    <select name="religion" class="form-control" selected = {{ $request[0]['religion'] }}>
                                        <option value="">Pilih Agama</option>
                                        <option value="Buddha" {{ ($request->religion) == "Buddha" ? "selected" : "" }}>Buddha</option>
                                        <option value="Hindu" {{ ($request->religion) == "Hindu" ? "selected" : "" }}>Hindu</option>
                                        <option value="Islam" {{ ($request->religion) == "Islam" ? "selected" : "" }}>Islam</option>
                                        <option value="Kristen Protestan" {{ ($request->religion) == "Kristen Protestan" ? "selected" : "" }}>Kristen Protestan</option>
                                        <option value="Katolik" {{ ($request->religion) == "Katolik" ? "selected" : "" }}>Katolik</option>
                                        <option value="Lainnya" {{ ($request->religion) == "Lainnya" ? "selected" : "" }}>Lainnya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="co col-md-3">Alamat</div>
                                <div class="col-12 col-md-9">
                                    <textarea name="address" rows="6" class="form-control" placeholder="Alamat">{{ $request->address }}</textarea>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="co col-md-3">Sekolah Asal</div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="ex_school" placeholder="Sekolah Asal" class="form-control" value="{{ $request->ex_school }}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="co col-md-3">Alamat Sekolah Asal</div>
                                <div class="col-12 col-md-9">
                                    <textarea name="ex_school_address"rows="6" placeholder="Alamat Sekolah Asal" class="form-control">{{ $request->ex_school_address }}</textarea>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="co col-md-3">Tahun Diterima</div>
                                <div class="col-12 col-md-9">
                                    <input type="number" name="date_received" max="{{ date('Y') }}" placeholder="Tahun Diterima" class="form-control" value="{{ $request->date_received }}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="co col-md-3">Nama Ayah</div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="father_name" placeholder="Nama Ayah" class="form-control" value="{{ $request->father_name }}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="co col-md-3">Nama Ibu</div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="mother_name" placeholder="Nama Ibu" class="form-control" value="{{ $request->mother_name }}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="co col-md-3">HP/Telp Orang Tua</div>
                                <div class="col-12 col-md-9">
                                    <input type="tel" name="parents_phone" placeholder="HP/Telp Orang Tua" class="form-control" value="{{ $request->parents_phone }}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="co col-md-3">Alamat Orang Tua</div>
                                <div class="col-12 col-md-9">
                                    <textarea name="parents_address"rows="6" placeholder="Alamat Orang Tua" class="form-control">{{ $request->parents_address }}</textarea>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="co col-md-3">Nama Wali</div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="guardian_name" placeholder="Nama Wali" class="form-control" value="{{ $request->guardian_name }}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="co col-md-3">Alamat Wali</div>
                                <div class="col-12 col-md-9">
                                    <textarea name="guardian_address" rows="6" placeholder="Alamat Wali" class="form-control">{{ $request->guardian_address }}</textarea>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="co col-md-3">HP/Telp Wali</div>
                                <div class="col-12 col-md-9">
                                        <input type="tel" name="guardian_phone" placeholder="HP/Telp Wali" class="form-control" value="{{ $request->guardian_phone }}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="co col-md-3">Jurusan</div>
                                <div class="col-12 col-md-9">
                                    <select name="departments_id" class="form-control">
                                        <option value="">Pilih Jurusan</option>
                                        @foreach ($departments as $req)
                                            @if ($req->status == 'Aktif')
                                                <option value="{{ $req->id }}" class {{ ($request->departments_id) == $req->id ? "selected" : "" }}>{{ $req->department_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row form-group float-right">
                                <div class="col">
                                    <button class="btn btn-sm btn-primary">Simpan</button>
                                    <a href="{{ url('/students') }}" class="btn btn-sm btn-danger">Batal</a>
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