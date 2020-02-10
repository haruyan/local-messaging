
<!DOCTYPE html>
<html style="height: 100vh">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Login | Criminal System Admin</title>
    <!-- Favicon-->
    <link rel="icon" href="{{asset('material/favicon.ico')}}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{asset('material/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{asset('material/plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{asset('material/plugins/animate-css/animate.css')}}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{asset('material/css/style.css')}}" rel="stylesheet">
</head>

<body class="login-page">
    <div class="login-margin">
                <div class="row">
                   <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                {{-- Login box --}}
                <div class="login-box">
                    <div class="login-logo" style="text-align: center;">
                        <img src="{{ asset('img/logo.png') }}" alt="logo">
                    </div>
                    <div class="logo">
                        <a>Crime <b>Justice</b> System</a>
                    </div>
                    <div class="card">
                        <div class="body">
                            <form id="sign_in" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="msg">Login</div>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">person</i>
                                    </span>
                                    <div class="form-line">
                                        <input id="username" type="text" class="form-control" value="{{ old('username') }}" name="username" placeholder="Username" required autofocus>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">lock</i>
                                    </span>
                                    <div class="form-line">
                                        <input id="password" type="password" class="form-control @error('password') error @enderror" name="password" placeholder="Password" required  autocomplete="current-password">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-xs-8 p-t-5">
                                        <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-deep-orange" {{ old('remember') ? 'checked' : '' }}>
                                        <label for="rememberme">Remember Me</label>
                                    </div>
                                    <div class="col-xs-4">
                                        <button class="btn btn-block bg-red waves-effect" type="submit">LOGIN</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- End Login Box --}}
            </div>
            
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <div class="info-box-2 bg-red" style="    min-height: 120px;    background-color: #961b11 !important;">
                        <div class="content align-center" style="width:100%">
                            <div class="text-front">
                                <p style="font-size: 1.8em;">Sistem Sinergitas Polres-Kejaksaan-Pengadilan-Lapas</p>
                            </div>
                            <div class="number">Wilayah Brebes</div>
                        </div>
                    </div>
                </div>
                  
                    <div >
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 m-t-125 align-center">
                            <img src="{{ asset('img/logo_(1).png') }}" style="  height: 130px"/>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 m-t-125 align-center">
                            <img src="{{ asset('img/logo_(2).png') }}"style="  height: 130px"/>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 m-t-125 align-center">
                            <img src="{{ asset('img/logo_(3).png') }}"style=" height: 130px"/>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 m-t-125 align-center">
                            <img src="{{ asset('img/logo_(4).png') }}"style=" width: 130px; height: 130px"/>
                        </div>
                    </div>
                </div>
            </div>
            
        
    </div>

    <!-- Jquery Core Js -->
    <script src="{{asset('material/plugins/jquery/jquery.min.js')}}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{asset('material/plugins/bootstrap/js/bootstrap.js')}}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{asset('material/plugins/node-waves/waves.js')}}"></script>

    <!-- Validation Plugin Js -->
    <script src="{{asset('material/plugins/jquery-validation/jquery.validate.js')}}"></script>

    <!-- Custom Js -->
    <script src="{{asset('material/js/admin.js')}}"></script>
    <script src="{{asset('material/js/pages/examples/sign-in.js')}}"></script>
</body>

</html>