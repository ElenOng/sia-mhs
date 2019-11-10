@extends('layouts.layout')
@section('content')
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Laporan Nilai Siswa {{ $classes->class_name }}</h1>
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
                        <a href="{{ route('report-student') }}" class="btn btn-sm btn-danger"><i class="fa fa-1x fa-arrow-circle-left"> Kembali</i></a>
                    </label>
                </div>
            </div>
        </div>
    <form action="{{ route('report-student-class-find', $classes->id) }}" method="post">
    @csrf
        <div class="row">
            <div class="col-sm-3">
                    <div id="bootstrap-data-table-filter" class="dataTables-filter">
                        <label>
                            <select name="students_id" id="" class="form-control form-control-sm" style="width: 260px">
                                <option value="">Pilih Siswa</option>
                                @foreach($classes->class_detail as $details)
                                    <option value="{{ $details->student->id }}">{{ $details->student->name }}</option>
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
        <div class="row">
            @if($students == null)
                <div class="col-md-12">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <td colspan="5">Belum ada data yang dipilih..</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            @else
                <div class="col-md-12">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <td colspan="5">{{ $students->name }}</td>
                            </tr>
                        </thead>
                    </table>
                </div>
                @if(count($arrayValue) < 1)
                <div class="col-md-12">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>
                                    Tidak ada data
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
                @else
                    @foreach($data_subject as $data)
                        <div class="col-md-12">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            {{ $data->subject->subject_name }}
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dropdown float-right">
                                        <button class="btn btn-sm btn-success dropdown-toggle float-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-1x fa-download"></i> Unduh
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{ route('download-students',[$students->id, $classes->id, $data->subjects_id, 2 ]) }}">Nilai Pengetahuan</a>
                                            <a class="dropdown-item" href="{{ route('download-students',[$students->id, $classes->id, $data->subjects_id, 1 ]) }}">Nilai Keterampilan</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-head">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active" id="custom-nav-home-tab" data-toggle="tab" href="#custom-nav-home-{{ $data->id }}" role="tab" aria-controls="custom-nav-home" aria-selected="true">Nilai Pengetahuan</a>
                                            <a class="nav-item nav-link" id="custom-nav-profile-tab" data-toggle="tab" href="#custom-nav-profile-{{ $data->id }}" role="tab" aria-controls="custom-nav-profile" aria-selected="false">Nilai Keterampilan</a>
                                        </div>
                                    </nav>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="custom-nav-home-{{ $data->id }}" role="tabpanel" aria-labelledby="custom-nav-home-tab">
                                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                                <tr>
                                                    <th>Kurikulum Dasar</th>
                                                    <th>Topik</th>
                                                    <th>Nilai</th>
                                                    <th>Bobot</th>
                                                    <th>Rata-rata</th>
                                                    <th>Total</th>
                                                </tr>
                                                @foreach($arrayValue as $arrs)
                                                    @foreach($arrs as $arr)
                                                        @if($arr->subjects_details_id == $data->id && $arr->types_id == 2)
                                                        <tr>
                                                            <td>{{ $arr->basic_cur }}</td>
                                                            <td>{{ $arr->value_desc }}</td>
                                                            <td>{{ $arr->value_detail[0]->value }}</td>
                                                            <td>{{ $arr->weight }}</td>
                                                            <td>{{ $arr->value_detail[0]->average }}</td>
                                                            <td>{{ $arr->value_detail[0]->total }}</td>
                                                        </tr>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="custom-nav-profile-{{ $data->id }}" role="tabpanel" aria-labelledby="custom-nav-profile-tab">
                                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                            <tr>
                                                <th>Kurikulum Dasar</th>
                                                <th>Topik</th>
                                                <th>Nilai</th>
                                                <th>Bobot</th>
                                                <th>Rata-rata</th>
                                                <th>Total</th>
                                            </tr>
                                            @foreach($arrayValue as $arrs)
                                                @foreach($arrs as $arr)
                                                    @if($arr->subjects_details_id == $data->id && $arr->types_id == 1)
                                                    <tr>
                                                        <td>{{ $arr->basic_cur }}</td>
                                                        <td>{{ $arr->value_desc }}</td>
                                                        <td>{{ $arr->value_detail[0]->value }}</td>
                                                        <td>{{ $arr->weight }}</td>
                                                        <td>{{ $arr->value_detail[0]->average }}</td>
                                                        <td>{{ $arr->value_detail[0]->total }}</td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                <!-- 
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-head">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="custom-nav-home-tab" data-toggle="tab" href="#custom-nav-home" role="tab" aria-controls="custom-nav-home" aria-selected="true">Nilai Pengetahuan</a>
                                    <a class="nav-item nav-link" id="custom-nav-profile-tab" data-toggle="tab" href="#custom-nav-profile" role="tab" aria-controls="custom-nav-profile" aria-selected="false">Nilai Keterampilan</a>
                                </div>
                            </nav>
                        </div>
                        <div class="card-body">
                            <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="custom-nav-home" role="tabpanel" aria-labelledby="custom-nav-home-tab">
                                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Kurikulum Dasar</th>
                                                <th>Topik</th>
                                                <th>Nilai</th>
                                                <th>Bobot</th>
                                                <th>Rata-rata</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>3.1</td>
                                                <td>Penugasan</td>
                                                <td>100</td>
                                                <td>1</td>
                                                <td>100</td>
                                                <td>100</td>
                                            </tr>
                                            <tr>
                                                <td>3.2</td>
                                                <td>Tugas Rumah</td>
                                                <td>100</td>
                                                <td>2</td>
                                                <td>100</td>
                                                <td>200</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="custom-nav-profile" role="tabpanel" aria-labelledby="custom-nav-profile-tab">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">

                                    <thead>
                                        <tr>
                                            <th>Kurikulum Dasar</th>
                                            <th>Topik</th>
                                            <th>Nilai</th>
                                            <th>Bobot</th>
                                            <th>Rata-rata</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>3.1</td>
                                            <td>Proyek</td>
                                            <td>100</td>
                                            <td>2</td>
                                            <td>100</td>
                                            <td>200</td>
                                        </tr>
                                        <tr>
                                            <td>3.2</td>
                                            <td>Presentasi 1</td>
                                            <td>100</td>
                                            <td>1</td>
                                            <td>100</td>
                                            <td>100</td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Mata Pelajaran</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-head">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="custom-nav-home-tab" data-toggle="tab" href="#custom-nav-home" role="tab" aria-controls="custom-nav-home" aria-selected="true">Nilai Pengetahuan</a>
                                    <a class="nav-item nav-link" id="custom-nav-profile-tab" data-toggle="tab" href="#custom-nav-profile" role="tab" aria-controls="custom-nav-profile" aria-selected="false">Nilai Keterampilan</a>                            
                                </div>
                            </nav>
                        </div>
                        <div class="card-body">
                            <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="custom-nav-home" role="tabpanel" aria-labelledby="custom-nav-home-tab">
                                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Kurikulum Dasar</th>
                                                <th>Topik</th>
                                                <th>Nilai</th>
                                                <th>Bobot</th>
                                                <th>Rata-rata</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>3.1</td>
                                                <td>Penugasan</td>
                                                <td>100</td>
                                                <td>1</td>
                                                <td>100</td>
                                                <td>100</td>
                                            </tr>
                                            <tr>
                                                <td>3.2</td>
                                                <td>Tugas Rumah</td>
                                                <td>100</td>
                                                <td>2</td>
                                                <td>100</td>
                                                <td>200</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="custom-nav-profile" role="tabpanel" aria-labelledby="custom-nav-profile-tab">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">

                                    <thead>
                                        <tr>
                                            <th>Kurikulum Dasar</th>
                                            <th>Topik</th>
                                            <th>Nilai</th>
                                            <th>Bobot</th>
                                            <th>Rata-rata</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>3.1</td>
                                            <td>Proyek</td>
                                            <td>100</td>
                                            <td>2</td>
                                            <td>100</td>
                                            <td>200</td>
                                        </tr>
                                        <tr>
                                            <td>3.2</td>
                                            <td>Presentasi 1</td>
                                            <td>100</td>
                                            <td>1</td>
                                            <td>100</td>
                                            <td>100</td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            @endif
        </div>
    </div>
</div>
@endsection
