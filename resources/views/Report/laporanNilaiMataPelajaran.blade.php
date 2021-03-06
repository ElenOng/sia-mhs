@extends('layouts.layout')
@section('content')
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Laporan Nilai Siswa</h1>
			</div>
		</div>
	</div>
</div>
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Kelas</th>
                            <th>Semester</th>
                            <th>Tahun Ajaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($classes) < 1)
                            <tr>
                                <td colspan="4">
                                    Tidak ada data kelas
                                </td>
                            </tr>
                        @else
                            @foreach($classes as $class)
                            <tr>
                                <td>{{ $class->class_name }}</td>
                                <td>{{ $class->semester }}</td>
                                <td>{{ $class->school_year }}</td>
                                <td>
                                    <form action="{{ route('report-subject-class', $class->id) }}" method="post">
                                        @csrf
                                        <button class="btn btn-sm btn-success"><i class="fa fa-1x fa-eye"></i></button>
                                    </form>
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
