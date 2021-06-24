<html lang="en">    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Vendor</title>
        <link href="{{ asset('techone/images/' . $style->small_logo) }}" rel="icon">
        <link href="{{ asset('assets/node_modules/@coreui/icons/css/coreui-icons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/node_modules/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/node_modules/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/node_modules/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/node_modules/@coreui/coreui-pro/dist/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/node_modules/spinkit/css/spinkit.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/node_modules/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">

        <link href="{{ asset('assets/vendors/pace-progress/css/pace.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendors/bootstrap-daterangepicker/css/daterangepicker.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/node_modules/select2/dist/css/select-2.min.css') }}" rel="stylesheet">

        <link href="{{ asset('assets/ample/css/animate.css')}}" rel="stylesheet">
        <link href="{{ asset('assets/ample/plugins/bower_components/jquery-wizard-master/steps.css')}}" rel="stylesheet">
        <link href="{{ asset('assets/ample/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
        <link href="{{ asset('assets/ample/plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.css')}}" rel="stylesheet">
        <link href="{{ asset('assets/ample/plugins/bower_components/jquery-asColorPicker-master/dist/css/asColorPicker.css')}}" rel="stylesheet">
        <link href="{{ asset('assets/ample/plugins/bower_components/timepicker/bootstrap-timepicker.min.css')}}" rel="stylesheet">
        <link href="{{ asset('assets/ample/plugins/bower_components/jasny-bootstrap/css/jasny-bootstrap.min.css')}}" rel="stylesheet">

        <link href="{{ asset('assets/css/tagsinput.css')}}" rel="stylesheet">
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
        <style>
            .swal-wide {
                width:1000px !important;
                background-color: transparent;
            }
            .swal-wide-small {
                width:500px !important;
                background-color: transparent;
            }
            .swal-wide-register {
                width: 400px;
                background-color: transparent;
                background: transparent;
            }
            .field-icon {
                float: right;
                margin-left: -25px;
                margin-right: 5px;
                margin-top: -25px;
                position: relative;
                z-index: 2;
            }
            .remove-border {
                border-top: none;
                border-bottom: none;
                border-left: none;
                border-right: none;
            }
            #catatan-vendor-modal .modal-content .modal-body #body-catatan {
                overflow-y: hidden;
                overflow-x: hidden;
            }
            .window {
                background: #fff;
                width: 100%;
                max-height: 300px;
                margin: auto;
                padding: 10px;
                box-sizing: border-box;
                position: relative;
                overflow-y: scroll;
                overflow-x: hidden;
                box-sizing: content-box;
            }
            .home-btn{
                height: 45px;
                width: 45px;
                margin-top: 10px;
                margin-left: auto;
                margin-right: auto;
                border-radius: 23px;
                border: 1px solid #444;
                background: #222;
            }
            .home-btn .hb-square{
                background: none;
                width: 23px;
                height: 23px;
                margin: 10px;
                border-radius: 4px;
                border: 1px solid #444;
            }

            .chat{
                background: #72b8ff;
                border-radius: 20px;
                display: inline-block;
                padding: 10px;
                color: #fff;
                font-weight: lighter;
                font-size: small;
                box-shadow: 1px 1px 2px rgba(0,0,0,.3);
                margin: 5px;
                position: relative;
            }
            .chat.u1{
                float: left;
                clear: both;
                border-top-left-radius: 0px;
                word-break: break-all;
            }
            .chat.u1:before{
                content: "";
                width: 0px;
                height: 0px;
                display: inline-block;
                border-left: 5px solid transparent;
                border-right: 5px solid #72b8ff;
                border-top: 5px solid #72b8ff;
                border-bottom: 5px solid transparent;
                position: absolute;
                top: 0px;
                left: -10px;
                word-break: break-all;
            }
            .chat.u2{
                float: right;
                clear: both;
                border-top-right-radius: 0px;
                background: #00D025;
                word-break: break-all;
            }
            .chat.u2:before{
                content: "";
                width: 0px;
                height: 0px;
                display: inline-block;
                border-left: 5px solid #00D025;
                border-right: 5px solid transparent;
                border-top: 5px solid #00D025;
                border-bottom: 5px solid transparent;
                position: absolute;
                top: 0px;
                right: -10px;
                word-break: break-all;
            }

            .new-chat{
                position: absolute;
                bottom: 0px;
                width: 100%;
                background: #ededed;
                height: 40px;
                left: 0px;
                border-top: 1px solid #ddd;
            }
            .new-chat input{
                outline: none;
                padding: 10px;
                box-sizing: border-box;
                font-size: 18px;
                width: 250px;
                height: 40px;
                border: none;
                display: inline-block;
                color: #999;
                font-weight: 100;
                background: #ddd;
            }
            .new-chat button{
                width: 40px;
                height: 30px;
                padding: 0;
                display: inline-block;
                border: none;
                color: #00D025;
                background: none;
                position: relative;
                top: -3px;
                outline: none;
                cursor: pointer;
            }
            .new-chat button:active{
                color: #555;
            }
        </style>
        @stack('styles')
    </head>
    <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show" {{-- oncontextmenu="return false;" --}}>
        @include('vendor::layouts.header')
        <div class="app-body">
            @if(!Auth::guest())
            <div class="sidebar">
                <nav class="sidebar-nav">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('vendor', [Auth()->user()->group->code]) }}">
                                <i class="nav-icon icon-speedometer"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item nav-dropdown">
                            <a class="nav-link nav-dropdown-toggle" href="#">
                                <i class="nav-icon fa fa-cogs"></i> Produk
                            </a>
                            <ul class="nav-dropdown-items">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('vendor.product', [Auth()->user()->group->code, Illuminate\Support\Facades\Crypt::encryptString('product')]) }}">
                                        <i class="nav-icon fa fa-registered"></i> Manajemen Produk
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('vendor.product.contract', [Auth()->user()->group->code, Illuminate\Support\Facades\Crypt::encryptString('product_contract')]) }}">
                                        <i class="nav-icon fa fa-check-circle-o"></i> Kontrak Produk
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item nav-dropdown">
                            <a class="nav-link nav-dropdown-toggle" href="#">
                                <i class="nav-icon fa fa-cogs"></i> Pemesanan
                            </a>
                            <ul class="nav-dropdown-items">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('vendor.order', [Auth()->user()->group->code, Illuminate\Support\Facades\Crypt::encryptString('vendororder')]) }}">
                                        <i class="nav-icon fa fa-registered"></i> Order
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <button class="sidebar-minimizer brand-minimizer" type="button"></button>
            </div>
            @endif
            @if(!Auth::guest())
            <main class="main">
            @else
            <main class="main" style="width:100%; margin:0;">
            @endif
                @yield('content')
            </main>
        </div>
        @include('vendor::layouts.footer')
        <script src="{{ asset('assets/node_modules/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/node_modules/popper.js/dist/umd/popper.min.js') }}"></script>
        <script src="{{ asset('assets/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/node_modules/pace-progress/pace.min.js') }}"></script>
        <script src="{{ asset('assets/node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets/node_modules/@coreui/coreui-pro/dist/js/coreui.min.js') }}"></script>
        <script src="{{ asset('assets/node_modules/jquery.maskedinput/src/jquery.maskedinput.js') }}"></script>
        <script src="{{ asset('assets/node_modules/moment/min/moment.min.js') }}"></script>
        <script src="{{ asset('assets/node_modules/select2/dist/js/select2.min.js') }}"></script>
        <script src="{{ asset('assets/node_modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
        <script src="{{ asset('assets/node_modules/datatables.net/js/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('assets/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js') }}"></script>
        <script src="{{ asset('assets/node_modules/sweetalert2/dist/sweetalert2.min.js') }}"></script>

        <script src="{{ asset('assets/ample/plugins/bower_components/moment/moment.js')}}"></script>
        <script src="{{ asset('assets/ample/plugins/bower_components/jquery-wizard-master/jquery.steps.min.js')}}"></script>
        <script src="{{ asset('assets/ample/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
        <script src="{{ asset('assets/ample/plugins/bower_components/blockUI/jquery.blockUI.js')}}"></script>
        <script src="{{ asset('assets/ample/plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.js')}}"></script>
        <script src="{{ asset('assets/ample/plugins/bower_components/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js')}}"></script>
        <script src="{{ asset('assets/ample/plugins/bower_components/timepicker/bootstrap-timepicker.min.js')}}"></script>
        <script src="{{ asset('assets/ample/plugins/bower_components/jasny-bootstrap/js/jasny-bootstrap.min.js')}}"></script>

        <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.bootstrap4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.1.2/handlebars.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
        <script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>

        <script src="{{ asset('assets/js/tagsinput.js')}}"></script>
        <script src="{{ asset('assets/js/advanced-forms.js') }}"></script>
        <script src="{{ asset('assets/js/datatables.js') }}"></script>
        <script src="{{ asset('assets/js/init.js') }}"></script>
        @toastr_js
        @toastr_render
        <script>
            function isNumberKey(evt) {
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if (charCode != 46 && charCode > 31 
                && (charCode < 48 || charCode > 57))
                return false;
                return true;
            }

            function showAlertSubmit(title, message, form, condition) {
                var html = `<div style="z-index:9999999;padding:0;margin:0;">
                                <div class="modal-dialog modal-xl modal-primary" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">`+title+`</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    `+message+`
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="tutupSwal" class="btn btn-md btn-danger float-right"><i class="fa fa-times"></i> Tutup</button>`;
                                        if(condition) {
                html +=                     `<button id="submitSwal" class="btn btn-md btn-success float-right"><i class="fa fa-check-circle-o"></i> Ya</button>`;
                                        }
                html +=                 `</div>
                                    </div>
                                </div>
                            </div>`;
                Swal.fire({
                    customClass: 'swal-wide-small',
                    html: html,
                    onOpen: function() {
                        $('#tutupSwal').click(function() {
                            swal.close(); return false;
                        });
                        $('#submitSwal').click(function() {
                            form.submit();
                        });
                    },
                    showCancelButton: false,
                    showConfirmButton: false
                })
            }
        </script>
        @stack('scripts')
    </body>
    
</html>
