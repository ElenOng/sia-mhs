@extends('layouts.layout')
@section('content')
<div class="breadcrumbs">
	<div class="col-sm-6">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Daftar Nilai </h1>
			</div>
		</div>
	</div>
</div>
<div class="content mt-3">
    <div class="row">
        <div class="col-sm-6">
            <a href="{{ route('score-list', [$type, $id, $find]) }}" class="btn btn-sm btn-danger"><i class="fa fa-1x fa-arrow-circle-left"></i> Kembali</a>
            <a href="{{ route('score-list-detail-edit', [$type, $id, $find, $values_id]) }}" class="btn btn-sm btn-success"><i class="fa fa-1x fa-edit"></i> Ubah Nilai</a>
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
                        <th>Nilai</th>
                        <th>Bobot</th>
                        <th>Rata-rata</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($response as $res)
                        <tr>
                            <td>{{ $res->student->name }}</td>
                            <td>{{ $res->value }}</td>
                            <td>{{ $res->valued->weight }}</td>
                            <td>{{ $res->average }}</td>
                            <td>{{ $res->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection