<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    @include('layouts.header')
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 align-left">
                        <a href="{{ route('download-subjects-back') }}" class="btn btn-sm btn-danger">Kembali</a>
                    </div>
                    <div class="col-lg-6 text-right">
                        <a href="{{ route('subjects-pdf', [$subjects[0]->subject->id , $classes->id, $types_id]) }}" class="btn btn-sm btn-success">Unduh</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="pb-2 display-5">Laporan Nilai Mata Pelajaran</h2>
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
                            Kelas : {{ $classes->class_name }}
                        </p>
                        <p>
                            Mata Pelajaran : {{ $subjects[0]->subject->subject_name }}
                        </p>
                        <p>
                            {{ $type }}
                        </p>
                    </div>
                </div>
                @if($titles)
                
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
                                    <th colspan="{{ ($types_id) == 2 ? 14 : 11 }}">{{ $value['name'] }}</th>
                                </tr>
                                    @foreach($value['value'] as $val)
                                        <tr>
                                            <td>{{ $val['basic_cur'] }}</td>
                                            @foreach($val['value_detail'] as $item)
                                                <td>{{ $item->value }}</td>
                                                <td>{{ $item->valued->weight }}</td>
                                                <td>{{ $item->total }}</td>
                                            @endforeach
                                            <td>{{ $val['grand_total'] }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th colspan="{{ ($types_id) == 2 ? 12 : 9 }}">Total Akhir</th>
                                        <th colspan="2">{{ $value['grand'] }}</th>
                                    </tr>
                                @endforeach
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
