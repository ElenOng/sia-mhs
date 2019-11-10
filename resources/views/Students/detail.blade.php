@extends('layouts.layout')
@section('content')
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Siswa</h1>
			</div>
		</div>
	</div>
</div>
<div class="content mt-3">
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
                <a href="{{ url('/students') }}" class="btn btn-sm btn-primary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
