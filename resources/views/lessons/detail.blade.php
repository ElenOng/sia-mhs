@extends('layouts.layout')
@section('content')
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Mata Pelajaran</h1>
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
                                <th>Nama Mata Pelajaran</th>
                                <td>{{ $req->subject_name }}</td>
                            </tr>
                            <tr>
                                <th>Alias</th>
                                <td style="text-transform:uppercase;">{{ $req->alias }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Mata Pelajaran</th>
                                <td>{{ $req->subject_type }}</td>
                            </tr>
                            <tr>
                                <th>KKM</th>
                                <td>{{ $req->min_value }}</td>
                            </tr>
                            <tr>
                                <th>Jurusan</th>
                                <td>{{ $req->department->department_name }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{ $req->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ url('/lessons') }}" class="btn btn-sm btn-primary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
