@extends('layouts.template')

@section('title')
Edit User
@endsection

@section('head-scripts')
	@include('partials.header-form')
@endsection

@section('content')
<section class="content">
	<div class="container-fluid">
		
		<div class="row clearfix">
		    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		        <div class="card">
		            <div class="header">
		                <h2>
		                    Edit User
						</h2>
		            </div>
		            <div class="body">

						@if ($message = Session::get('success'))
							<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">×</button> 
								<strong>{{ $message }}</strong>
							</div>
						@endif

						<form class="form-horizontal"  method="POST" action="{{ route('users.update', $user->id) }}" id="formNew">
							@method('PATCH') 
							@csrf
							
							<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
								<label for="role">Instansi</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
								<select name="instansi" class="form-control show-tick">
									<option value="">Pilih Instansi</option>
									@foreach($instansi as $item)
										<option value="{{ $item->id }}" {{ $user->instansi_id == $item->id ? 'selected' : '' }}>{{ strtoupper($item->nama) }}</option>
									@endforeach
								</select>
							</div>
			
							<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
								<label for="nama-user">Nama User</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
								<div class="input-group">
									<div class="form-line">
										<input type="text" id="nama-user" class="form-control" placeholder="Masukkan Nama User" name="nama" value="{{$user->nama}}" autofocus>
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
								<label for="role">Role</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
								<div class="input-group">
									<div class="form-line">
										<select name="role" class="form-control show-tick">
											<option value="">Pilih Role</option>
											<option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }} >Admin</option>
											<option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
										</select>
									</div>
								</div>
							</div>

							<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
								<label for="profile-pict">Foto Profil</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
								<div class="input-group">
										<div class="input-group">
											<input type="file" id="profile-pict" name="profile_pict" class="form-control">
										</div>
								</div>
							</div>

		                    <div class="row clearfix">
		                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
									<button type="submit" class="btn btn-primary m-t-15 waves-effect">Simpan</button>
									<a href="{{ route('users.index') }}">
										<button type="button" class="btn btn-danger m-l-15 m-t-15 waves-effect">Batal</button>
									</a>
		                        </div>
		                    </div>
		                </form>
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
										window.location = "/users";
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