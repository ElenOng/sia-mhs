@extends('layouts.layout')
@section('content')
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Ubah Nilai</h1>
			</div>
		</div>
	</div>
</div>
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body card-block">
                        @if ($errors->any())
                            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <br>
                        @endif
                        <form action="{{ route('score-update', [$type, $find]) }}" method="post" class="form-horizontal">
                            @csrf
                            {{ method_field('PATCH') }}
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Topik Nilai</th>
                                        <th>Bobot</th>
                                    </tr>
                                    @foreach($response as $res)
                                        <tr>
                                            <td>{{ $res->value_desc }}</td>
                                            <td>
                                                <input type="hidden" name="identity" value="{{ $id }}">
                                                <input type="hidden" name="id[]" value="{{ $res->id }}">
                                                <input type="number" name="weight[]" min="1" max="5" value="{{ $res->weight }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="row form-group float-right">
                                <div class="col">
                                    <button class="btn btn-sm btn-primary">Simpan</button>
                                    <a href="{{ route('score-detail', [$type, $id]) }}" class="btn btn-sm btn-danger">Batal</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection