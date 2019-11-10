@extends('layouts.layout')
@section('content')
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Tambah Nilai</h1>
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
                        @if (session('valid'))
                            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                <ul>
                                    <li>{{ session('valid') }}</li>
                                </ul>
                            </div>
                            <br>
                        @endif
                        <form action="{{ route('score-store', $type) }}" method="post" class="form-horizontal">
                            @csrf
                            <input type="hidden" name="subjects_details_id" value="{{ $id }}">
                            <div class="row form-group">
                                <div class="col col-md-3">KD</div>
                                <div class="col-12 col-md-9">
                                    <select name="basic_cur" class="form-control">
                                        <option value="">Pilih KD</option>
                                        <option value="3.1">3.1</option>
                                        <option value="3.2">3.2</option>
                                        <option value="3.3">3.3</option>
                                        <option value="3.4">3.4</option>
                                        <option value="3.5">3.5</option>
                                        <option value="3.6">3.6</option>
                                        <option value="3.7">3.7</option>
                                    </select>
                                </div>
                            </div>
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