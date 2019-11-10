<header id="header" class="header">
    <div class="header-menu">
        <div class="col-sm-7">
            <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
        </div>
        <div class="col-sm-5">
            <div class="user-area dropdown float-right">
                <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-1x fa-gear"></i> Pengaturan Pengguna</a>

                <div class="user-menu dropdown-menu">
                    <a class="nav-link" href="{{ url('/profil') }}"><i class="fa fa-1x fa-user"></i> {{ Auth::user()->username }}</a>
                    <a class="nav-link" href="{{ url('/logout') }}"><i class="fa fa-power-off"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>
</header>