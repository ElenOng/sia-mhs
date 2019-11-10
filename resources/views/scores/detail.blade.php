@extends('layouts.layout')
@section('content')
<div class="breadcrumbs">
	<div class="col-sm-6">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Pengolahan Nilai {{ $data->subject->subject_name }}</h1>
			</div>
		</div>
	</div>
</div>
<div class="content mt-3">
    <div class="row">
        <div class="col-sm-6">
            <a href="{{ route('score-index', $type) }}" class="btn btn-sm btn-danger"><i class="fa fa-1x fa-arrow-circle-left"></i> Kembali</a>
            <a href="{{ route('score-create',[$type, $data->id]) }}" class="btn btn-sm btn-primary"><i class="fa fa-1x fa-plus"></i> Tambah Data</a>
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
                        <th>Kurikulum Dasar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($response) < 1)
                        <tr>
                            <td colspan="4">Tidak ada data nilai yang tercatat</td>
                        </tr>
                    @else
                        @foreach($response as $res)
                            <tr>
                                <td>{{ $res->basic_cur }}</td>
                                <td>
                                    <a href="{{ route('score-list', [$type, $data->id, $res->basic_cur]) }}" class="btn btn-sm btn-success"><i class="fa fa-1x fa-eye"></i></a>
                                    <a href="{{ route('score-edit', [$type, $data->id, $res->basic_cur]) }}" class="btn btn-sm btn-primary"><i class="fa fa-1x fa-edit"></i></a>
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