@extends('layouts.layout')
@section('content')
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Profil {{ $auth->username }}</h1>
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
                    @if (session('error'))
                        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                            <ul>
                                <li>{{ session('error') }}</li>
                            </ul>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                            <ul>
                                <li>{{ session('success') }}</li>
                            </ul>
                        </div>
                    @endif
                    <form action="{{ url('/changePassword') }}" method="post" class="form-horizontal">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="row form-group">
                            <div class="col col-md-3">Kata Sandi Lama</div>
                            <div class="col-12 col-md-9">
                                <input type="password" name="old_pass" placeholder="Kata Sandi Lama" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">Kata Sandi Baru</div>
                            <div class="col-12 col-md-9">
                                <input type="password" name="new_pass" placeholder="Kata Sandi Baru" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">Konfirmasi Kata Sandi Baru</div>
                            <div class="col-12 col-md-9">
                                <input type="password" name="conf_pass" placeholder="Konfirmasi Kata Sandi" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group float-right">
                            <div class="col-md-12">
                                <button class="btn btn-sm btn-primary">Ubah Kata Sandi</button>
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
