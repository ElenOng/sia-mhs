@extends('layouts.layout')
@section('content')
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Guru</h1>
			</div>
		</div>
	</div>
</div>
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-6">
                <a href="{{ url('/teachers/create') }}" class="btn btn-sm btn-primary"><i class="fa fa-1x fa-plus"></i> Tambah Data</a>
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
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Jabatan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if (count($request) < 1)
                            <tr>
                                <td colspan="6">Tidak ada data Guru</td>
                            </tr>
                        @else
                            @for ($i=0; $i< count($request) ; $i++)
                                <tr>
                                    <td>{{ $request[$i]->employee_number }}</td>
                                    <td>{{ $request[$i]->teacher_name }}</td>
                                    <td>{{ $request[$i]->gender }}</td>

                                        @for ($j =0 ; $j <count($request[$i]->users) ; $j++)
                                            @if ($request[$i]->users[$j]->username == $request[$i]->employee_number)
                                                <td>
                                                    {{ $request[$i]->users[$j]->roles->role }}
                                                </td>
                                                @if($request[$i]->users[$j]->statuses->status == 'Aktif')
                                                    <td><span class="badge badge-success">Aktif</span></td>
                                                @else
                                                    <td><span class="badge badge-danger">Tidak Aktif</span></td>
                                                @endif
                                                @break
                                            @endif
                                        @endfor
                                    <td>
                                        <a href="{{ route('edit-teachers',$request[$i]->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-1x fa-edit"></i></a>
                                        @if($request[$i]->users[$j]->statuses->status == 'Aktif')
                                        <a href="{{ route('deactive-teachers',$request[$i]->id) }}"onclick="return confirm('Apakah anda ingin mengnonaktifkan guru ini ?')" class="btn btn-sm btn-danger"><i class="fa fa-1x fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endfor
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
