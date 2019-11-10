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
    <form action="{{ route('score-list-update', [$type, $id, $find, $values_id]) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-sm-6">
                <a href="{{ route('score-list-edit', [$type, $id, $find, $values_id]) }}" class="btn btn-sm btn-danger"><i class="fa fa-1x fa-arrow-circle-left"></i> Kembali</a>
                <button class="btn btn-sm btn-primary"><i class="fa fa-1x fa-save"></i> Simpan Perubahan</button>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($response as $res)
                            <tr>
                                <td>{{ $res->student->name }}</td>
                                <input type="hidden" name="id[]" value="{{ $res->id }}">
                                <td width="20%">
                                    <input type="number" name="value[]" class="form-control" min="0" max="100" value="{{ $res->value }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</div>
@endsection