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
                                <th>NIP</th>
                                <td>{{ $req->employee_number }}</td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>{{ $req->teacher_name }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Lahir</th>
                                <td>{{ $req->birth_date }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>{{ $req->gender }}</td>
                            </tr>
                            <tr>
                                <th>Gelar</th>
                                <td>{{ $req->degree }}</td>
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