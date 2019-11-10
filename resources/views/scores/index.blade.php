@extends('layouts.layout')
@section('content')
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Pengolahan Nilai {{ ($type == 'knowledge') ? "Pengetahuan" : "Keterampilan" }}</h1>
			</div>
		</div>
	</div>
</div>
<div class="content mt-3">
    <div class="row">
        <div class="col-sm-12">
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
                        <th>Mata Pelajaran</th>
                        <th>Guru Pengajar</th>
                        <th>Kelas</th>
                        <th>Semester</th>
                        <th>Tahun Ajaran</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($response) < 1)
                    <tr>
                        <td colspan="7">Belum ada data Mata Pelajaran yang ditampilkan</td>
                    </tr>
                    @else
                        @foreach($response as $res)
                            <tr>
                                <td>{{ $res->subject->subject_name }}</td>    
                                <td>{{ $res->teacher->teacher_name }}</td>
                                <td>{{ $res->class->class_name }}</td>
                                <td>{{ $res->class->semester }}</td>
                                <td>{{ $res->class->school_year }}</td>
                                @if($res->class->status == 'Aktif')
                                    <td><span class="badge badge-success">Aktif</span></td>
                                @else
                                    <td><span class="badge badge-danger">Tidak Aktif</span></td>
                                @endif
                                <td>
                                    <a href="{{ route('score-detail', [$type, $res->id]) }}" class="btn btn-sm btn-success"><i class="fa fa-1x fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection