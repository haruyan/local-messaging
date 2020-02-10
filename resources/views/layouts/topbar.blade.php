<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="{{ route('dashboard') }}">Criminal Justice System</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <!-- Notifications -->
                <li><a href="{{ route('users.profile') }}"><i class="material-icons">person</i></a></li>
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" id="drop-notif" data-toggle="dropdown" role="button">
                        <i class="material-icons">notifications</i>
                            <span class="label-count " id="notif-jumlah">{{ $notification['count'] }}</span>
                        
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">SURAT MASUK</li>
                        <li class="body">
                            <ul class="menu align-center scroll-notif" id="notif-data">
                                <div class="preloader m-t-60 pl-size-xs ajax-load">
                                    <div class="spinner-layer pl-green">
                                        <div class="circle-clipper left">
                                            <div class="circle"></div>
                                        </div>
                                        <div class="circle-clipper right">
                                            <div class="circle"></div>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                            <ul class="header align-center"  style="padding-bottom: 0 !important; display:none;" id="preloader-bottom">
                                <li class='waves-effect marked'>
                                    <div class="preloader pl-size-xs ajax-load">
                                        <div class="spinner-layer pl-green">
                                            <div class="circle-clipper left">
                                                <div class="circle"></div>
                                            </div>
                                            <div class="circle-clipper right">
                                                <div class="circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="{{ route('inbox') }}">Lihat semua surat masuk</a>
                        </li>
                    </ul>
                </li>
                <!-- #END# Notifications -->                
                <!-- #Change Color Button -->
                <!-- <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li> -->
            </ul>
        </div>
    </div>
</nav>
