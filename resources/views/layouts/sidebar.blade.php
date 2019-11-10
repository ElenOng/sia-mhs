<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="./">SIA MHS</a>
            <a class="navbar-brand hidden" href="./">M</a>
        </div>
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="{{ url('/beranda') }}"> <i class="menu-icon fa fa-dashboard"></i>Beranda </a>
                </li>
                <h3 class="menu-title" style="{{ (Auth::user()->roles_id)== 3 ? "" : "display: none" }}">Pengguna</h3>
                <li style="{{ (Auth::user()->roles_id)== 3 ? "" : "display: none" }}">
                    <a href="{{ url('/students') }}"> <i class="menu-icon ti-user"></i>Siswa </a>
                </li>
                <li style="{{ (Auth::user()->roles_id)== 3 ? "" : "display: none" }}">
                    <a href="{{ url('/teachers') }}"> <i class="menu-icon ti-briefcase"></i>Guru </a>
                </li>
                {{-- <li style="{{ (Auth::user()->roles_id)== 3 ? "" : "display: none" }}">
                    <a href="{{ url('/roles') }}"> <i class="menu-icon ti-direction-alt"></i>Jabatan </a>
                </li> --}}
                <li style="{{ (Auth::user()->roles_id)== 3 ? "" : "display: none" }}">
                    <a href="{{ url('/statuses') }}"> <i class="menu-icon ti-write"></i>Data Status</a>
                </li>
                <h3 class="menu-title" style="{{ (Auth::user()->roles_id)== 3 ? "" : "display: none" }}">Sekolah</h3>
                <li class="menu-item-has-children dropdown"  style="{{ (Auth::user()->roles_id)== 3 ? "" : "display: none" }}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-building"></i>Sekolah</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{ url('/departments') }}">Jurusan</a></li>
                        <li><i class="menu-icon ti-agenda"></i><a href="{{ url('/classes') }}">Kelas</a></li>
                    </ul>
                </li>
                <li style="{{ (Auth::user()->roles_id)== 3 ? "" : "display: none" }}">
                    <a href="{{ url('/lessons') }}"> <i class="menu-icon ti-book"></i>Pelajaran </a>
                </li>
                <h3 class="menu-title">Nilai</h3>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-book"></i>Nilai Siswa</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-globe"></i><a href="{{ route('score-index', 'knowledge') }}">Nilai Pengetahuan</a></li>
                        <li><i class="menu-icon fa fa-laptop"></i><a href="{{ route('score-index', 'skill') }}">Nilai Keterampilan</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon ti-archive"></i>Laporan</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon ti-write"></i><a href="{{ route('report-student') }}">Laporan Nilai Siswa</a></li>
                        <li><i class="menu-icon ti-write"></i><a href="{{ route('report-subject') }}">Laporan Nilai Mata Pelajaran</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
