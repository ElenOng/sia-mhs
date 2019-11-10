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
            <div class="col-sm-6">
                <a href="{{ url('/lessons/create') }}" class="btn btn-sm btn-primary"><i class="fa fa-1x fa-plus"></i> Tambah Data</a>
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
                        <th>Alias</th>
                        <th>Jurusan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if ($request->count() < 1 )
                            <tr>
                                <td colspan="4">Belum ada data Mata Pelajaran</td>
                            </tr>
                        @else
                            @foreach($request as $req)
                            <tr>
                                <td style="text-transform: uppercase;">{{ $req->alias }}</td>
                                <td>{{ $req->department->department_name }}</td>
                                <td>
                                    @if($req->status == 'Aktif')
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('edit-subject', $req->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-1x fa-edit"></i></a>
                                @if($req->status == 'Aktif')
                                    <a href="{{ route('deactive-subject',$req->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda ingin mengnonaktifkan Mata Pelajaran ini ?')"><i class="fa fa-1x fa-trash"></i></a>
                                @endif
                                    <a href="{{ route('show-subject', $req->id) }}" class="btn btn-sm btn-success"><i class="fa fa-1x fa-eye"></i></a>
                                </td>
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