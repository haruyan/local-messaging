@extends('layouts.template')

@section('title')
Profile User
@endsection

@section('head-scripts')
	@include('partials.header-form')
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-3">
                <div class="card profile-card">
                    <div class="profile-header">&nbsp;</div>
                    <div class="profile-body">
                        <div class="image-area">
                            <img src="/{{ $user->profile_pict }}" class="profile-img" alt="Profile Image" />
                        </div>
                        <div class="content-area">
                            <h3>{{ strtoupper($user->nama) }}</h3>
                            <p>{{ strtoupper($user->instansi->nama) }}</p>
                        </div>
                    </div>
<!--                     <div class="profile-footer">
                        <ul>
                            <li>
                                <span>Surat Terkirim</span>
                                <span>1.234</span>
                            </li>
                            <li>
                                <span>Surat Masuk</span>
                                <span>1.201</span>
                            </li>
                        </ul>
                    </div> -->
                </div>
            </div>
            {{-- End Profile Card --}}
            <div class="col-xs-12 col-sm-9">
                <div class="card">
                    <div class="body">
                        <div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#profile_settings" aria-controls="settings" role="tab" data-toggle="tab">Profile Settings</a></li>
                            </ul>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="profile_settings">
                                    {{-- <form class="form-horizontal">
                                        <div class="form-group">
                                            <label for="NameSurname" class="col-sm-2 control-label">Name Surname</label>
                                            <div class="col-sm-10">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="NameSurname" name="NameSurname" placeholder="Name Surname" value="Marc K. Hammond" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Email" class="col-sm-2 control-label">Email</label>
                                            <div class="col-sm-10">
                                                <div class="form-line">
                                                    <input type="email" class="form-control" id="Email" name="Email" placeholder="Email" value="example@example.com" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="InputExperience" class="col-sm-2 control-label">Experience</label>

                                            <div class="col-sm-10">
                                                <div class="form-line">
                                                    <textarea class="form-control" id="InputExperience" name="InputExperience" rows="3" placeholder="Experience"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="InputSkills" class="col-sm-2 control-label">Skills</label>

                                            <div class="col-sm-10">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="InputSkills" name="InputSkills" placeholder="Skills">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <input type="checkbox" id="terms_condition_check" class="chk-col-red filled-in" />
                                                <label for="terms_condition_check">I agree to the <a href="#">terms and conditions</a></label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn bg-red">SUBMIT</button>
                                            </div>
                                        </div>
                                    </form> --}}
                                    <form class="form-horizontal"  method="POST" action="{{ route('users.update', $user->id) }}" id="formNew">
                                        @method('PUT') 
                                        @csrf
                                        
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                            <label for="nama-user">Nama User</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                            <div class="input-group">
                                                <div class="form-line">
                                                    <input type="text" id="nama-user" class="form-control" placeholder="Masukkan Nama User" name="nama" value="{{ $user->nama }}">
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                            <label for="no_hp">Nomor HP</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                            <div class="input-group">
                                                <div class="form-line">
                                                    <input type="text" id="no_hp" class="form-control" placeholder="Masukkan Nomor HP User" value="{{ $user->no_hp }}" name="no_hp" >
                                                </div>
                                            </div>
                                        </div>
                        
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                            <label for="email">Email</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                            <div class="input-group">
                                                <div class="form-line">
                                                    <input type="email" id="email" class="form-control" placeholder="Masukkan Email User" value="{{ $user->email }}" name="email" >
                                                </div>
                                            </div>
                                        </div>
                        
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                            <label for="username">Username</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                            <div class="input-group">
                                                <div class="form-line">
                                                    <input type="text" id="username" class="form-control" placeholder="Masukkan Username  (untuk login)" value="{{ $user->username }}" name="username" >
                                                </div>
                                            </div>
                                        </div>
                        
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                            <label for="password">Password</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                            <div class="input-group">
                                                <div class="form-line">
                                                    <input type="password" id="password" class="form-control" placeholder="Masukkan Password  (jika ingin mengganti)" name="password" >
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                            <label for="password_confirmation">reType Password</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                            <div class="input-group">
                                                <div class="form-line">
                                                    <input type="password" id="password_confirmation" class="form-control" placeholder="Masukkan ulang Password (jika ingin mengganti)" name="password_confirmation" >
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                            <label for="profile-pict">Pilih Foto Profil</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                            <div class="input-group">
                                                    <div class="input-group">
                                                        <input type="file" id="profile-pict" name="profile_pict" class="form-control">
                                                    </div>
                                            </div>
                                        </div>
                                                                
                                        <div class="row clearfix">
                                            <div class="col-sm-offset-2 col-md-offset-2 col-sm-offset-5 col-xs-offset-5">
                                                <button type="submit" class="btn btn-primary m-t-10 waves-effect">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('end-scripts')
    @include('partials.footer-form')
    <script type="text/javascript" class="init">
        $(document).ready(function() {
            
            $('#formNew').on('submit',function(e){
                e.preventDefault();
                //console.log(e.target);
                let data = new FormData($('#formNew')[0])

                axios.post($('#formNew').attr('action'),data)
                    .then(response => {
                        if(response.data.error) {
                            console.log(response.data);
                            swal({
                                title: "Failed",
                                text: response.data.error,
                                type: 'error'
                            });
                        } else {
                            console.log(response.data);
                            swal({
                                title: 'Success',
                                text:"Berhasil Mengubah Data",
                                type:"success"}, 
                                function() {
                                        window.location = "/users/profile";
                                        } 
                                );	
                            $('#formNew')[0].reset();
                            $('#defaultModal').modal('hide')


                        }
                    })
                    .catch(error => {
                        let errors = ""
                        try {
                            errors = Object.values(error.response.data.errors).map(msg => msg[0])
                            errors = errors.join()
                            // console.log(msg)
                        } catch(e) {
                            error = "Gagal menambahkan Data"
                        }
                        swal({
                            title: "Failed",
                            text:errors,
                            type: 'error'
                        });
                    })
            })
        } );
    </script>
@endsection