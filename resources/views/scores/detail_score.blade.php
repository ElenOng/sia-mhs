@extends('layouts.layout')
@section('content')
<div class="breadcrumbs">
	<div class="col-sm-6">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>KD {{ $find }}</h1>
			</div>
		</div>
	</div>
</div>
<div class="content mt-3">
    <div class="row">
        <div class="col-sm-6">
            <a href="{{ route('score-detail', [$type, $id]) }}" class="btn btn-sm btn-danger"><i class="fa fa-1x fa-arrow-circle-left"></i> Kembali</a>
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
                        <th>Topik Nilai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $res)
                    <tr>
                        <td>{{ $res->value_desc }}</td>
                        <td><a href="{{ route('score-list-edit', [$type, $id, $find, $res->id]) }}" class="btn btn-sm btn-success"><i class="fa fa-1x fa-edit"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection