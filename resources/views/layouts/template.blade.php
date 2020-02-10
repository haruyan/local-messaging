<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>@yield('title') | Criminal Justice System</title>
    <!-- Favicon-->
    <link rel="icon" href="{{ asset('material/favicon.ico') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('material/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('material/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('material/plugins/animate-css/animate.css') }}" rel="stylesheet" />
    
    <!-- Sweetalert Css -->
    <link href="{{ asset('material/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" />
    
    <!-- Custom Css -->
    <link href="{{ asset('material/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    {{-- <link href="{{ asset('material/css/themes/all-themes.css') }}" rel="stylesheet" /> --}}
    <link href="{{ asset('material/css/themes/theme-amber.css') }}" rel="stylesheet" />
    
    @yield('head-scripts')
</head>

<body class="theme-amber">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    @include('layouts.topbar')
    <!-- #Top Bar -->
    @include('layouts.sidebar')

    @yield('content')

    <!-- Jquery Core Js -->
    <script src="{{ asset('material/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('material/plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Select Plugin Js -->
    <script src="{{ asset('material/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{ asset('material/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

    <!-- Sweet Alert Plugin Js -->
    <script src="{{ asset('material/plugins/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('material/plugins/node-waves/waves.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('material/js/admin.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('js/notify/notify.js') }}"></script>
    
    {{-- <script src="{{ asset('material/js/pages/ui/dialogs.js') }}"></script> --}}
    
    <!-- Demo Js -->
    <script src="{{ asset('material/js/demo.js') }}"></script>

    <script>
        $(document).ready(function() {
            axios.get('/api/v1/get-surat/'+ {{ Auth::user()->instansi_id  }})
                .then(response=>{
                    //console.log(response);
                    let count = response.data.unread.length;
                    if(count > 0){
                      $("#notif-jumlah").show();
                        welcomeThis(count); 
                        $("#notif-jumlah").text(count);
                    }
                    else{
                      $("#notif-jumlah").hide();//(count);
                    }
                })
                .catch(error=>{
                    console.log(error);
                });

            let counter;
            function Updaterate(){
                axios.get('/api/v1/get-surat/'+ {{ Auth::user()->instansi_id  }})
                    .then(response=>{
                        // console.log(response);
                        let count = response.data.all.length;
                        let countUnread = response.data.unread.length;
                        if(countUnread>0){
                          $("#notif-jumlah").show();
                          $("#notif-jumlah").text(countUnread);
                        }
                        else{
                          $("#notif-jumlah").hide();
                        }
                        
                        if(counter < count){
                            for(var i = 0; i < count - counter; i++){
                               // console.log(response.data.all[i]);
                                let pengirim = response.data.all[i].surat.pengirim.nama;
                                let id = response.data.all[i].surat.id;
                                notifyThis(pengirim, id);
                            }
                        }
                        counter = count;
                    })
                    .catch(error=>{
                        console.log(error);
                    });
            }
            
            var rateInterval = setInterval(Updaterate, 5000);
            
            let offset = 5;
            
            $("#drop-notif").on("click", function(){
                axios.get('/api/v1/get-surat/'+ {{ Auth::user()->instansi_id  }})
                    .then(response=>{
                        
                        
                        let count = 5;
                        offset = count;
                        let notifikasi = response.data.all;
                        var stringHtml = "";

                        for(var j = 0; j < count; j++){
                                // var html = "<li>"+"<a href='{{ route('surat.detail', "+notifikasi[j].surat_id+") }}'>";
                                var html = "<li>"+"<a href='/surat/detail/"+notifikasi[j].surat_id+"' class='waves-effect waves-block marked notif-id'>";
                                
                                var icon = "";
                                if(notifikasi[j].status =='terkirim'){
                                    icon = "<div class='icon-circle bg-light-blue'>"+
                                                    "<i class='material-icons'>mail</i>"+
                                                "</div>";
                                }
                                else{
                                    icon = "<div class='icon-circle bg-blue-grey'>"+
                                                    "<i class='material-icons'>drafts</i>"+
                                                "</div>";
                                }
                                
                                var body = "<div class='menu-info'>"+
                                                "<h4><small> surat dari - </small>"+notifikasi[j].surat.pengirim.nama.toUpperCase()+"</h4>"+
                                               "<p>"+
                                                    "<i class='material-icons'>attach_file</i> "+notifikasi[j].surat.nomor_surat+ 
                                               " </p>"+
                                               "<p>"+
                                                    "<i class='material-icons'>date_range</i> "+notifikasi[j].surat.tanggal_surat+ 
                                               " </p>"+
                                            "</div>"+
                                        "</a>"+
                                   " </li>";

                            stringHtml += (html+icon+body);
                        }
                        // console.log(stringHtml);
                        $("#notif-data").empty().append(stringHtml); 
                    })
                    .catch(error=>{
                        console.log(error);
                    });

            });
            
            $(".scroll-notif").scroll(function() {
                var ul = document.getElementById('notif-data');
                if(ul.offsetHeight + ul.scrollTop == ul.scrollHeight) {
                    $("#preloader-bottom").show();

                    axios.get('/api/v1/get-surat/'+{{ Auth::user()->instansi_id  }}+'/'+5+'/'+offset)
                    .then(response=>{
                        offset += response.data.length;
                        // console.log(response.data);
                        var stringHtml = "";
                        let notifikasi = response.data;
                        // console.log(notifikasi2[0].surat_id);
                        
                        for(var j = 0; j < notifikasi.length; j++){
                            // var html = "<li>"+"<a href='{{ route('surat.detail', "+notifikasi[j].surat_id+") }}'>";
                            var html = "<li>"+"<a href='/surat/detail/"+notifikasi[j].surat_id+"' class='waves-effect waves-block marked notif-id'>";
                            
                            var icon = "";
                            if(notifikasi[j].status =='terkirim'){
                                icon = "<div class='icon-circle bg-light-blue'>"+
                                                "<i class='material-icons'>mail</i>"+
                                            "</div>";
                            }
                            else{
                                icon = "<div class='icon-circle bg-blue-grey'>"+
                                                "<i class='material-icons'>drafts</i>"+
                                            "</div>";
                            }
                            
                            var body = "<div class='menu-info'>"+
                                            "<h4><small> surat dari - </small>"+notifikasi[j].surat.pengirim.nama.toUpperCase()+"</h4>"+
                                            "<p>"+
                                                "<i class='material-icons'>attach_file</i> "+notifikasi[j].surat.nomor_surat+ 
                                            " </p>"+
                                            "<p>"+
                                                "<i class='material-icons'>date_range</i> "+notifikasi[j].surat.tanggal_surat+ 
                                            " </p>"+
                                        "</div>"+
                                    "</a>"+
                                " </li>";
    
                            stringHtml += (html+icon+body);
                        }
                        // console.log(stringHtml);
                        $("#notif-data").append(stringHtml); 
                        $("#preloader-bottom").hide();
                    
                    })
                    .catch(error=>{
                        console.log(error);
                    });
                }
            });
        });

    </script>

    @yield('end-scripts')
</body>

</html>
