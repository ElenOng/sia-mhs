@extends('layouts.layout')
@section('content')
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Tambah Siswa</h1>
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
                        <form action="{{ url('/students/store') }}" method="post" class="form-horizontal">
                            @csrf
                            <div class="row form-group">
                                <div class="col col-md-3">NISN</div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="student_number" placeholder="NISN" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">Nama</div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="name" placeholder="Nama" class="form-control">
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
                                <div class="co col-md-3">Tempat Lahir</div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="birth_place" placeholder="Tempat Lahir" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="co col-md-3">Agama</div>
                                <div class="col-12 col-md-9">
                                    <select name="religion" class="form-control">
                                        <option value="">Pilih Agama</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen Protestan">Kristen Protestan</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="co col-md-3">Alamat</div>
                                <div class="col-12 col-md-9">
                                    <textarea name="address" rows="6" class="form-control" placeholder="Alamat"></textarea>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="co col-md-3">Sekolah Asal</div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="ex_school" placeholder="Sekolah Asal" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="co col-md-3">Alamat Sekolah Asal</div>
                                <div class="col-12 col-md-9">
                                    <textarea name="ex_school_address"rows="6" placeholder="Alamat Sekolah Asal" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="co col-md-3">Tahun Diterima</div>
                                <div class="col-12 col-md-9">
                                    <input type="number" name="date_received" min="2000" max="{{ date('Y') }}" placeholder="Tahun Diterima" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="co col-md-3">Nama Ayah</div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="father_name" placeholder="Nama Ayah" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="co col-md-3">Nama Ibu</div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="mother_name" placeholder="Nama Ibu" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="co col-md-3">HP/Telp Orang Tua</div>
                                <div class="col-12 col-md-9">
                                    <input type="tel" name="parents_phone" placeholder="HP/Telp Orang Tua" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="co col-md-3">Alamat Orang Tua</div>
                                <div class="col-12 col-md-9">
                                    <textarea name="parents_address"rows="6" placeholder="Alamat Orang Tua" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="co col-md-3">Nama Wali</div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="guardian_name" placeholder="Nama Wali" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="co col-md-3">Alamat Wali</div>
                                <div class="col-12 col-md-9">
                                    <textarea name="guardian_address" rows="6" placeholder="Alamat Wali" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="co col-md-3">HP/Telp Wali</div>
                                <div class="col-12 col-md-9">
                                        <input type="tel" name="guardian_phone" placeholder="HP/Telp Wali" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="co col-md-3">Jurusan</div>
                                <div class="col-12 col-md-9">
                                    <select name="departments_id" class="form-control">
                                        <option value="">Pilih Jurusan</option>
                                        @foreach ($request as $req)
                                            @if ($req->status == 'Aktif')
                                                <option value="{{ $req->id }}" class>{{ $req->department_name }}</option>
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
