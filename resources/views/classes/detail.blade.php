@extends('layouts.layout')
@section('content')
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Kelas {{ $request->class_name }}</h1>
			</div>
		</div>
	</div>
</div>
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-6">
                <a href="{{ url('/classes') }}" class="btn btn-sm btn-danger"><i class="fa fa-1x fa-arrow-circle-left"> Kembali</i></a>
                @if($request->status == 'Aktif')
                    <a href="{{ route('detail-create', $request->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-1x fa-plus"></i> Tambah Data Siswa</a>
                @endif
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
                        <th>Nama Siswa</th>
                        <th>Jenis Kelamin</th>
                        @if($request->status == 'Aktif')
                        <th>Aksi</th>
                        @endif
                      </tr>
                    </thead>
                    <tbody>
                        @if (count($request->class_detail)<1)
                            <tr>
                                <td colspan="3">Belum ada data Siswa</td>
                            </tr>
                        @else
                            @foreach ($request->class_detail as $req)
                                <tr>
                                    <td>{{ $req->student->name }}</td>
                                    <td>{{ $req->student->gender }}</td>
                                    @if($request->status == 'Aktif')
                                    <td>
                                        <form action="{{ route('class-detail-delete',$req->id) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Apakah anda ingin menghapus siswa ini dari kelas?')" class="btn btn-sm btn-danger"><i class="fa fa-1x fa-trash"></i></button>
                                        </form>
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
