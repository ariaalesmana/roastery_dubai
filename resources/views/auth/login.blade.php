<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>e-Katalog | Masuk</title>
        <link href="{{ asset('techone/images/inamartbar.png') }}" rel="icon">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link href="{{ asset('assets/ample/plugins/bower_components/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('techone/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/ample/plugins/bower_components/ionicons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/ample/plugins/bower_components/AdminLTE.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/ample/plugins/bower_components/blue.css') }}" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css" rel="stylesheet">
    </head>

    <body class="hold-transition login-page" style="background-image: url('{{ asset('techone/images/angkasapurabackground.jpg') }}'); background-size: cover;">
        <div class="login-box">
            <div class="login-box-body">

                <p><img class="img-responsive bounceIn animated" src="{{ asset('techone/images/logoinamart.png') }}"></p>
                <p class="login-box-msg"></p>
                <p class="login-box-msg">Masuk Aplikasi e-Katalog {{isset($url) ? $url : 'customer'}}</p>

				@if ($message = Session::get('error'))
					<div class="flex-sb-m w-full p-t-3 p-b-32">
						<p style="color:red;">{{ $message }}</p>
					</div>
				@endif
                @isset($url)
                    <form method="POST" action="{{ route("login.post.$url") }}">
                @else
                    <form method="POST" action="{{ route('login.post.customer') }}">
                @endisset
                    {{ csrf_field() }}
                    <div class="form-group has-feedback">
                        <input id="email" type="text" placeholder="Email" class="form-control" name="email" oninvalid="this.setCustomValidity('Masukkan Username')" required >
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input id="password" type="password" placeholder="Password" class="form-control" name="password" oninvalid="this.setCustomValidity('Masukkan Password')" required >
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">
                                Masuk
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script>
        </script>
    </body>
</html>