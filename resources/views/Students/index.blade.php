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
            <div class="col-sm-6">
                <a href="{{ url('/students/create') }}" class="btn btn-sm btn-primary"><i class="fa fa-1x fa-plus"></i> Tambah Data</a>
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
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Jurusan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if (count($request) < 1)
                            <tr>
                                <td colspan="5">Tidak ada data Siswa</td>
                            </tr>
                        @else
                            @foreach ($request as $req)
                                <tr>
                                    <td>{{ $req->name }}</td>
                                    <td>{{ $req->gender }}</td>
                                    <td>{{ $req->departments->department_name }}</td>
                                    @for ($i = 0; $i <= $loop->index; $i++)
                                        @if ($req->users[$i]->userstable_id == $req->id)
                                            @php $status = $req->users[$i]->statuses->status @endphp
                                            @if($status == 'Aktif')
                                                <td><span class="badge badge-success">Aktif</span></td>
                                            @else
                                                <td><span class="badge badge-danger">Tidak Aktif</span></td>
                                            @endif
                                            @break
                                        @endif
                                    @endfor
                                    <td>
                                        <a href="{{ route('edit-students', $req->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-1x fa-edit"></i></a>
                                        <a href="{{ route('detail-students', $req->id) }}" class="btn btn-sm btn-success"><i class="fa fa-1x fa-eye"></i></a>
                                        @if ($status == 'Aktif')
                                            <a href="{{ route('deactive-students',['DO', $req->id]) }}" onclick="return confirm('Apakah anda ingin DO siswa ini ?')" class="btn btn-sm btn-danger"><i class="fa fa-1x fa-trash"></i></a>
                                            <a href="{{ route('deactive-students',['Lulus', $req->id]) }}" onclick="return confirm('Apakah siswa ini sudah lulus ?')" class="btn btn-sm btn-warning"><i class="ti ti-1x ti-cup"></i></a>
                                        @endif
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
