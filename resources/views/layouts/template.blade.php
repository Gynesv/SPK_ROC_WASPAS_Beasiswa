<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>SPK PIP | SMKN 9 Padang</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Politeknik Negeri Padang" />
        <meta name="author" content="Siska Nofri Dania" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" href="{{ asset('resources/sources/images/favicon.png') }}">

        <link href="{{ asset('resources/sources/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('resources/sources/css/icons.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('resources/sources/css/metismenu.min.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('resources/sources/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('resources/sources/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('resources/sources/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('resources/sources/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet"  type="text/css">
        <link href="{{ asset('resources/sources/plugins/jquery-toast-plugin-master/src/jquery.toast.css') }}" rel="stylesheet">  
        <link href="{{ asset('resources/sources/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">

        <link href="{{ asset('resources/sources/css/style.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('resources/sources/css/app.css') }}" rel="stylesheet" type="text/css" />

        @section('css')   
        @show 
 
    </head>

    <body>

        <!-- BAGIAN TOPBAR -->
        
        <div class="topbar">
             <nav class="navbar-custom">
                
                <!-- TOPBAR POTONG MULAI -->
                
                @include('layouts.topbar')
                
                <!-- TOPBAR POTONG AKHIR -->

            </nav>
        </div>


        
        <div class="page-wrapper">
            <div class="page-wrapper-inner">

                <!-- BAGIAN MENU -->
                
                <div class="left-sidenav">
                    <ul class="metismenu left-sidenav-menu" id="side-nav">
                        
                    <!-- MENU POTONG AWAL -->
                    
                        @include('layouts.menu')
                    
                    <!-- MENU POTONG AKHIR -->

                    </ul>
                    
                </div>
                
                <!-- BAGIAN CONTENT -->
                
                <div class="page-content">
                    <div class="container-fluid"> 
                    
                    <!-- CONTENT POTONG AWAL -->

                        @yield('content')
                        
                        <!-- CONTENT POTONG AKHIR -->
                        
                    </div>
                    
                    <!-- BAGIAN FOOTER -->

                    <footer class="footer text-center text-sm-left">
                        
                        <!-- FOOTER POTONG AWAL -->
                        
                        @include('layouts.footer')
                        
                        <!-- FOOTER POTONG AKHIR -->
                    </footer>
                </div>

            </div>

        </div>

        <script src="{{ asset('resources/sources/js/jquery.min.js') }}"></script>
        <script src="{{ asset('resources/sources/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('resources/sources/js/metisMenu.min.js') }}"></script>
        <script src="{{ asset('resources/sources/js/waves.min.js') }}"></script>
        <script src="{{ asset('resources/sources/js/jquery.slimscroll.min.js') }}"></script>

        <script src="{{ asset('resources/sources/js/app.js') }}"></script>
        <script src="{{ asset('resources/sources/js/my.js') }}"></script>

        <script src="{{ asset('resources/sources/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('resources/sources/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

        <script src="{{ asset('resources/sources/plugins/select2/select2.min.js') }}"></script>
        <script src="{{ asset('resources/sources/plugins/sweetalert/sweetalert.min.js') }}"></script>
        <script src="{{ asset('resources/sources/plugins/sweetalert/jquery.sweet-alert.custom.js') }}"></script>
        <script src="{{ asset('resources/sources/plugins/jquery-toast-plugin-master/src/jquery.toast.js') }}"></script>
        <script src="{{ asset('resources/sources/plugins/moment/moment.js') }}"></script>

        <script src="{{ asset('resources/sources/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('resources/sources/plugins/input-mask/jquery.inputmask.js') }}"></script>
        <script src="{{ asset('resources/sources/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>

        @section('js')
        @show

    </body>
</html>