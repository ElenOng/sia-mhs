@extends('layouts.layout_student')
@section('content')
<div class="container">
<div id="right-panel" class="right-panel">
	<header id="header" class="header">
		<div class="header-menu">
			<div class="col-sm-3">
				<a href="#">
					<img class="align-content" src="{{ asset('suffer-admin/images/logo_sia.png') }}" alt="Foto" width="60%" height="60%">
				</a>
			</div>
			<div class="col-sm-6 text-center">
				<h2 class="pb-2 display-5">Sistem Informasi Akademik</h2>
				<h5 class="pb-2 display-5">SMK Multistudi High School Batam</h5>
			</div>
			<div class="col-sm-3 text-right">
				<a class="btn btn-sm btn-link" href="{{ url('/logout') }}" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-1x fa-sign-out"></i> Keluar</a>
			</div>
		</div>
	</header>
	<div class="container">
		<div class="breadcrumbs">
			<div class="row">
				<div class="col-sm-6">
					<div class="page-header float-left">
						<div class="page-title">
                            <h1>Kelas : {{ $class->class_name }}</h1>
                            <h1>Wali Kelas : {{ $class->teacher->teacher_name }}</h1>
                            <p>Semester : {{ $class->semester }} | Tahun Ajaran {{ $class->school_year }}</p>
						</div>
					</div>
				</div>
			</div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="animated fadeIn">
                            <form action="" method="post">
                                <b>Mata Pelajaran</b>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <select name="subjects_id" id="" class="form-control form-control-sm">
                                            <option value="">Pilih Mata Pelajaran</option>
                                            @foreach($subjects as $value)
                                                <option value="{{ $value->subjects_id }}">{{ $value->subject->subject_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <form action="{{ route('class-detail', [$student->id, $class->id]) }}" method="post">
                                            @csrf
                                            <button class="btn btn-sm btn-primary"><i class="fa fa-1x fa-search"></i> Cari</button>
                                            <a href="{{ route('home-student') }}" class="btn btn-sm btn-danger">Kembali</a>
                                        </form>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($subject)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h6>{{ $subject[0]->subject->subject_name }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="animated fadeIn">
                            <div class="row">
                                <div class="col-md-12">
                                    <h6 class="pb-2 display-5">Nilai Pengetahuan</h6>
                                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Kurikulum Dasar</th>
                                                @foreach($title_knowledge as $knowledge)
                                                    <th>{{ $knowledge }}</th>
                                                    <th>Bobot</th>
                                                    <th>Total</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($value_knowledge->count() > 0)
                                                @foreach($basic_knowledge as $bk)
                                                <tr>
                                                    <td>{{ $bk->basic_cur }}</td>
                                                    @foreach($value_knowledge as $vk)
                                                        @if($vk->basic_cur == $bk->basic_cur)
                                                            <td>{{ $vk->value_detail[0]->value }}</td>
                                                            <td>{{ $vk->weight }}</td>
                                                            <td>{{ $vk->value_detail[0]->total }}</td>
                                                        @endif
                                                    @endforeach
                                                </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="13">Tidak Ada Data Nilai</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <h6 class="pb-2 display-5">Nilai Keterampilan</h6>
                                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Kurikulum Dasar</th>
                                                @foreach($title_skill as $skill)
                                                    <th>{{ $skill }}</th>
                                                    <th>Bobot</th>
                                                    <th>Nilai</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($value_skill) > 0)
                                                @foreach($basic_skill as $bk)
                                                <tr>
                                                    <td>{{ $bk->basic_cur }}</td>
                                                    @foreach($value_skill as $vk)
                                                        @if($vk->basic_cur == $bk->basic_cur)
                                                            <td>{{ $vk->value_detail[0]->value }}</td>
                                                            <td>{{ $vk->weight }}</td>
                                                            <td>{{ $vk->value_detail[0]->total }}</td>
                                                        @endif
                                                    @endforeach
                                                </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="10">Tidak Ada Data Nilai</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
	</div>
</div>
@endsection
@section('footer')
<footer class="footer">
	<div class="container">
		<p class="text-muted">&copy; 2019 Universitas Atma Jogja Fakultas Teknologi Industri Program Studi Teknik Informatika Elen 15 07 08131 </p>
	</div>
</footer>
@endsection


