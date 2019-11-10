<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    @include('layouts.header')
</head>
<body>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 align-left">
                        <a href="{{ route('download-students-back') }}" class="btn btn-sm btn-danger">Kembali</a>
                    </div>
                    <div class="col-lg-6 text-right">
                        <a href="{{ route('students-pdf',[$students->id, $classes->id, $data_subject[0]->id, $types_id]) }}" class="btn btn-sm btn-success">Unduh</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="pb-2 display-5">Laporan Nilai Siswa</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center typo-articles">
                        <h6 class="pb-4 display-5">Sekolah Menengah Kejuruan Multistudi High School Kota Batam</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <p>
                            Nama : {{ $students->name }}
                        </p>
                        <p>
                            Kelas : {{ $classes->class_name }}
                        </p>
                        <p>
                            Mata Pelajaran : {{ $data_subject[0]->subject->subject_name }}
                        </p>
                        <p>
                            {{ $type }}
                        </p>
                    </div>
                </div>
                @if($basic_cur)
                <div class="row">
                    <div class="col-lg-12">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ $title_data['basic_cur'] }}</th>
                                    @foreach($title_data['content'] as $title)
                                        <th>{{ $title['title'] }}</th>
                                        <th>{{ $title['weight'] }}</th>
                                        <th>{{ $title['total'] }}</th>
                                    @endforeach
                                    <th>{{ $title_data['grand_total'] }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $value)
                                    <tr>
                                        <td>{{ $value['name'] }}</td>
                                        @foreach($value['details'] as $val)
                                            <td>{{ $val['value'] }}</td>
                                            <td>{{ $val['weight'] }}</td>
                                            <td>{{ $val['total'] }}</td>
                                        @endforeach
                                        <td>{{ $value['grand'] }}</td>
                                    </tr>
                                    @endforeach
                                <tr>
                                    <th colspan="{{ ($types_id) == 2 ? 13 : 10 }}">Nilai Rapor</th>
                                    <th>{{ $grand_score }}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@include('layouts.script')
</body>
</html>
