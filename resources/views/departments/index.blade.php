@extends('layouts.layout')
@section('content')
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Jurusan</h1>
			</div>
		</div>
	</div>
</div>
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-6">
                <a href="{{ url('departments/create') }}" class="btn btn-sm btn-primary"><i class="fa fa-1x fa-plus"></i> Tambah Data</a>
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
                        <th>Nama Jurusan</th>
                        <th>Prefix</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if (count($request) <1)
                            <tr>
                                <td colspan="4">Belum ada data Jurusan</td>
                            </tr>
                        @else
                            @foreach ($request as $req)
                                <tr>
                                    <td>{{ $req->department_name }}</td>
                                    <td>{{ $req->prefix }}</td>
                                    @if ($req->status == 'Aktif')
                                        <td><span class="badge badge-success">Aktif</span></td>
                                    @else
                                    <td><span class="badge badge-danger">Tidak Aktif</span></td>  
                                    @endif
                                    <td>
                                        <a href="{{ route('edit-departments',$req->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-1x fa-edit"></i></a>
                                        @if($req->status == 'Aktif')
                                            <a href="{{ route('deactive-departments', $req->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda ingin mengnonaktifkan jurusan ini ?')"><i class="fa fa-1x fa-trash"></i></a>                                           
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                {{-- {{ $request->links() }} --}}
            </div>
        </div>
    </div>
</div>
@endsection