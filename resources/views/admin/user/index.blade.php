@extends('layouts.template')

@section('title')
Admin User
@endsection

@section('head-scripts')
	@include('partials.header-table')

	<link rel="stylesheet" href="{{ asset('material/plugins/bootstrap-select/css/bootstrap-select.css') }}">
@endsection


@section('content')
<section class="content">
	<div class="container-fluid">
		
		<!-- Basic Examples -->
		<div class="row clearfix">
		    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		        <div class="card">
		            <div class="header">
		                <h2>
		                    DAFTAR USER
						</h2>
						<ul class="header-dropdown">
							<button type="button" class="btn bg-blue m-r-15 waves-effect" data-toggle="modal" data-target="#defaultModal">
								<i class="material-icons">add</i>
								<span>TAMBAH USER</span>
							</button>
		                </ul>
		            </div>
		            <div class="body">
		                <div class="table-responsive">
		                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="js-basic-example">
		                        <thead>
		                            <tr>
										<th>No</th>
										<th>Nama</th>
										<td>Username</td>
		                                <th>Email</th>
										<th>No. HP</th>
										<th>User</th>
										<th>Foto</th>
										<th>Action</th>
		                            </tr>
		                        </thead>
		                        <tfoot>
									<tr>
										<th>No</th>
										<th>Nama</th>
										<td>Username</td>
										<th>Email</th>
										<th>No. HP</th>
										<th>User</th>
										<th>Foto</th>
										<th>Action</th>
									</tr>
		                        </tfoot>
		                        <tbody>
                                    @foreach ($users as $i => $user)
                                        <tr>
                                        <td>{{ $i+1 }}</td>
										<td>{{ $user->nama }}</td>
										<td>{{ $user->username }}</td>
										<td>{{ $user->email }}</td>
										<td>{{ $user->no_hp }}</td>
										<td>{{ strtoupper($user->instansi->nama) }}</td>
										<td><img src="/{{ $user->profile_pict }}" alt="Foto Profil" style="width: 40px; height: 40px;"></td>
                                        <td>
											<form action="{{ route('users.destroy', $user->id)}}" method="post" id="js-sweetalert-{{ $user->id }}">
												@csrf
												@method('DELETE')
												<a href="{{ route('users.edit',$user->id) }}">
													<button type="button" class="btn btn-success waves-effect">
														<i class="material-icons">create</i>
													</button>
												</a>
												<button type="submit" class="btn btn-danger waves-effect" data-id="{{ $user->id }}" onclick="swal1({{$user->id}})">
													<i class="material-icons">delete</i>
												</button>
											</form>
                                        </td>
                                        </tr>
                                    @endforeach
		                        </tbody>
		                    </table>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	</div>	
</section>
<!-- Modal Dialogs ====================================================================================================================== -->
<div class="modal fade p-t-5" id="defaultModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel">TAMBAH USER</h4>
			</div>
			<form class="form-horizontal" id="formNew" action="{{ route('users.store') }}">
				@csrf

				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
					<label for="role">Instansi</label>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
					<div class="input-group">
						<select name="instansi" class="form-control show-tick">
							<option value="">Pilih Instansi</option>
							@foreach($instansi as $item)
								<option value="{{ $item->id }}">{{ strtoupper($item->nama) }}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
					<label for="nama-user">Nama User</label>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
					<div class="input-group">
						<div class="form-line">
							<input type="text" id="nama-user" class="form-control" placeholder="Masukkan Nama User" name="nama"  autofocus>
						</div>
					</div>
				</div>

				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
					<label for="email">Email</label>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
					<div class="input-group">
						<div class="form-line">
							<input type="email" id="email" class="form-control" placeholder="Masukkan Email User" name="email" >
						</div>
					</div>
				</div>

				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
					<label for="no_hp">Nomor HP</label>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
					<div class="input-group">
						<div class="form-line">
							<input type="text" id="no_hp" class="form-control" placeholder="Masukkan Nomor HP User" name="no_hp" >
						</div>
					</div>
				</div>

				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
					<label for="username">Username</label>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
					<div class="input-group">
						<div class="form-line">
							<input type="text" id="username" class="form-control" placeholder="Masukkan Username  (untuk login)" name="username" >
						</div>
					</div>
				</div>

				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
					<label for="password">Password</label>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
					<div class="input-group">
						<div class="form-line">
							<input type="password" id="password" class="form-control" placeholder="Masukkan Password  (untuk login)" name="password" >
						</div>
					</div>
				</div>
				
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
					<label for="password_confirmation">reType Password</label>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
					<div class="input-group">
						<div class="form-line">
							<input type="password" id="password_confirmation" class="form-control" placeholder="Masukkan reType Password" name="password_confirmation" >
						</div>
					</div>
				</div>

				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
					<label for="profile-pict">Pilih Foto Profil</label>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
					<div class="input-group">
							<div class="input-group">
								<input type="file" id="profile-pict" name="profile_pict" class="form-control" required>
							</div>
					</div>
				</div>

				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
					<label for="role">Role</label>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
					<div class="input-group">
						<div class="form-line">
							<select name="role" class="form-control show-tick">
								<option value="">Pilih Role</option>
								<option>admin</option>
								<option>user</option>
							</select>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-link waves-effect">SIMPAN</button>
					<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">BATAL</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('end-scripts')

    <!-- Select Plugin Js -->
	<script src="{{ asset('material/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
	
	@include('partials.footer-table')
	@include('partials.sweetalert')

	<script type="text/javascript" class="init">
		$(document).ready(function() {
			$('#js-basic-example').DataTable({
				"columnDefs": [
					{ "width": "20%", "target": 2 },
					{ "width": "80px", "target": 0 }
				]
			});

			$('#formNew').on('submit',function(e){
				e.preventDefault();
				console.log(e.target);
				let data = new FormData($('#formNew')[0])

				axios.post($('#formNew').attr('action'),data)
					.then(response => {
						if(response.data.error) {
							console.log(response.data);

						} else {
							swal({
							title: 'Success',
							text:"Berhasil Menambahkan Data",
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
							error = "Gagal menambahkan User"
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