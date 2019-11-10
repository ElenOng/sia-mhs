<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sistem Informasi Akademik</title>
    <link rel="stylesheet" href="{{ asset('suffer-admin/vendors/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('suffer-admin/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('suffer-admin/vendors/themify-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('suffer-admin/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('suffer-admin/vendors/selectFX/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('suffer-admin/vendors/jqvmap/dist/jqvmap.min.css') }}">


    <link rel="stylesheet" href="{{ asset('suffer-admin/assets/css/style.css') }}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body class="bg-dark">
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-form">
                    <div class="login-logo">
                        <a href="#">
                            <img class="align-content" src="{{ asset('suffer-admin/images/logo_sia.png') }}" alt="Foto" width="50%" height="50%">
                        </a>
                    </div>
                    @if(session('errors'))
                        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                            <p>
                                {{ session('errors') }}
                            </p>
                        </div>
                    @endif
                    <div class="sufee-alert alert with-close alert-primary alert-dismissible fade show text-center">
                    <small style="color: danger;">Jika anda belum pernah mengubah kata sandi anda maka anda harus masuk dengan kata sandi YYYY-MM-DD (YYYY : Tahunn Lahir | MM : Bulan Lahir 2 digit | DD : Tanggal Lahir 2 Digit)</small>
                    </div>
                    <form action="{{ url('/login') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>NIS/NIK</label>
                            <input type="text" name="username" class="form-control" placeholder="NIS/NIK">
                        </div>
                        <div class="form-group">
                            <label>Kata Sandi</label>
                            <input type="password" name="password" class="form-control" placeholder="Kata Sandi">
                        </div>
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
    <footer id="sticky-footer" class="py-4 bg-dark text-white-50">
        <div class="container text-center">
            <small>Copyright &copy; Tugas Akhir | Universitas Atma Jaya Yogyakarta | Elen | 15 07 08131 | Fakultas Teknologi Industri | Teknik Informatika</small>
        </div>
    </footer>









    <script src="{{ asset('suffer-admin/vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('suffer-admin/vendors/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('suffer-admin/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('suffer-admin/assets/js/main.js') }}"></script>


    <script src="{{ asset('suffer-admin/vendors/chart.js/dist/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('suffer-admin/assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('suffer-admin/assets/js/widgets.js') }}"></script>
    <script src="{{ asset('suffer-admin/vendors/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('suffer-admin/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    <script src="{{ asset('suffer-admin/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script>
        (function($) {
            "use strict";

            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        })(jQuery);
    </script>
</body>
</html>