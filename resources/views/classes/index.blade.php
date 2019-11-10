@extends('layouts.layout')
@section('content')
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Kelas</h1>
			</div>
		</div>
	</div>
</div>
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-6">
                <a href="{{ url('classes/create') }}" class="btn btn-sm btn-primary"><i class="fa fa-1x fa-plus"></i> Tambah Data</a>
            </div>
            <div class="col-sm-6">
                <div id="bootstrap-data-table-filter" class="dataTables-filter float-right">
                    <label>
                        {{-- <form action="" method="get"> --}}
                        <input type="search" name="q" class="form-control form-control-sm" placeholder="pencarian">
                        {{-- </form> --}}
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Nama Kelas</th>
                        <th>Jumlah Siswa</th>
                        <th>Semester</th>
                        <th>Tahun Ajaran</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if (count($request)<1)
                            <tr>
                                <td colspan="6">Belum ada data kelas</td>
                            </tr>
                        @else
                            @foreach ($request as $req)
                                <tr>
                                    <td>{{ $req->class_name }}</td>
                                    <td>{{ $req->class_detail->count() }}</td>
                                    <td>{{ $req->semester }}</td>
                                    <td>{{ $req->school_year }}</td>
                                    @if ($req->status == 'Aktif')
                                        <td><span class="badge badge-success">Aktif</span></td>
                                        <td>
                                            <a href="{{ route('class-subject', $req->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-1x fa-book"></i></a>
                                            <a href="{{ route('deactive-classes', $req->id) }}" onclick="return confirm('Apakah anda ingin menonaktifkan kelas ini ?')" class="btn btn-sm btn-danger"><i class="fa fa-1x fa-trash"></i></a>
                                            <a href="{{ route('detail-classes', $req->id) }}" class="btn btn-sm btn-success"><i class="fa fa-1x fa-eye"></i></a>
                                        </td>
                                    @else
                                        <td><span class="badge badge-danger">Tidak Aktif</span></td>
                                        <td>
                                                <a href="{{ route('class-subject', $req->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-1x fa-book"></i></a>
                                            <a href="{{ route('detail-classes', $req->id) }}" class="btn btn-sm btn-success"><i class="fa fa-1x fa-eye"></i></a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
