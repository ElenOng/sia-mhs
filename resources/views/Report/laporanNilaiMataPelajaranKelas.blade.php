@extends('layouts.layout')
@section('content')
<div class="breadcrumbs">
	<div class="col-sm-12">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Laporan Nilai Kelas {{ $classes->class_name }}</h1>
			</div>
		</div>
	</div>
</div>
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-6">
                <div class="dataTables-filter">
                    <label>
                        <a href="{{ route('report-subject') }}" class="btn btn-sm btn-danger"><i class="fa fa-1x fa-arrow-circle-left"> Kembali</i></a>
                    </label>
                </div>
            </div>
        </div>
        <form action="{{ route('report-subject-class', $classes->id) }}" method="post">
        @csrf
            <div class="row">
                <div class="col-sm-3">
                    <div id="bootstrap-data-table-filter" class="dataTables-filter">
                        <label>
                            <select name="filter" id="" class="form-control form-control-sm" style="width: 260px">
                                <option value="">Pilih Mata Pelajaran</option>
                                @foreach($subject_data as $subject)
                                    <option value="{{ $subject->subjects_id }}">{{ $subject->subject->subject_name }}</option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                </div>
                <div class="col-sm-3">
                    <label>
                        <button class="btn btn-sm btn-primary">Pilih</button>
                    </label>
                </div>
            </div>
        </form>
        @if($subject_detail)
        <div class="row">
            <div class="col-sm-12">
                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="50%">Nama Guru Pengajar</th>
                            <th>{{ $teacher->teacher_name }}</th>
                        </tr>
                        <tr>
                            <th width="50%">NIP</th>
                            <th>{{ $teacher->employee_number }}</th>
                        </tr>
                        <tr>
                            <th width="50%">Mata Pelajaran</th>
                            <th>{{ $subject_detail->subject->subject_name }}</th>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-1x fa-download"></i> Unduh
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{ route('download-subject', [$subject_detail->subject->id, $classes->id, 2]) }}">Nilai Pengetahuan</a>
                                        <a class="dropdown-item" href="{{ route('download-subject', [$subject_detail->subject->id, $classes->id, 1]) }}">Nilai Keterampilan</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </thead>
                </table>
            </div>
            
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    @foreach($values as $value)
                    <div class="card-body">
                        <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="custom-nav-home" role="tabpanel" aria-labelledby="custom-nav-home-tab">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Kurikulum Dasar : {{ $value->basic_cur }}</th>
                                            <th>Tipe : {{ $value->type->type }}</th>
                                            <th colspan="3">Topik : {{ $value->value_desc }}</th>
                                        </tr>        
                                        <tr>
                                            <th>Nama Siswa</th>
                                            <th>Nilai</th>
                                            <th>Bobot</th>
                                            <th>Rata-rata</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($value->value_detail as $val)
                                        <tr>
                                            <td>{{ $val->student->name }}</td>
                                            <td>{{ $val->value }}</td>
                                            <td>{{ $value->weight }}</td>
                                            <td>{{ $val->average }}</td>
                                            <td>{{ $val->total }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
