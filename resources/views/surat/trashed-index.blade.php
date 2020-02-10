@extends('layouts.template')

@section('title')
Kelola Surat
@endsection

@section('head-scripts')
	@include('partials.header-form')
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
		                    DAFTAR Surat
						</h2>
						<ul class="header-dropdown">
							<button type="button" class="btn bg-blue m-r-15 waves-effect" data-toggle="modal" data-target="#defaultModal">
								<i class="material-icons">add</i>
								<span>TAMBAH SURAT</span>
							</button>
		                </ul>
		            </div>
		            <div class="body">
		                <div class="table-responsive">
		                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="js-basic-example">
		                        <thead>
		                            <tr>
										<th>No</th>
		                                <th>Nama Surat</th>
		                                <th>Tanggal</th>
										<th>Penerima</th>
										<th>Menu</th>
		                            </tr>
		                        </thead>
		                        <tfoot>
									<tr>
                                        <th>No</th>
                                        <th>Nama Surat</th>
                                        <th>Tanggal</th>
                                        <th>Penerima</th>
                                        <th>Menu</th>
									</tr>
		                        </tfoot>
		                        <tbody>
                                    @foreach ($letter as $l => $surat)
                                        <tr>
                                        <td>{{ $l+1 }}</td>
										<td><a href="{{ url($surat->body) }}">{{ $surat->nomor_surat }}</a></td>
										<td>{{ $surat->tanggal_surat }}</td>
										<td>
											<ol>
											@foreach ($surat->penerima as $p)
												@foreach ($p->instansi as $i)
													<li>{{ $i->nama }}</li>
												@endforeach
											@endforeach
											</ol>
										</td>
                                        <td>
											<form action="{{ route('surat.destroy', $surat->id)}}" method="post" id="js-sweetalert-{{ $surat->id }}">
												@csrf
												@method('DELETE')
												<a href="{{ route('surat.edit',$surat->id) }}">
													<button type="button" class="btn btn-success waves-effect">
														<i class="material-icons">create</i>
													</button>
												</a>
												<button type="submit" class="btn btn-danger waves-effect" data-id="{{ $surat->id }}" onclick="swal1({{ $surat->id }})">
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
<div class="modal fade p-t-125" id="defaultModal" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="defaultModalLabel">TAMBAH TIPE SURAT</h4>
				</div>
				<form id="formNew" class="form-horizontal" method="POST" action="{{ route('surat.store') }}" enctype="multipart/form-data">
					@csrf
					
						<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
							<label for="letternumber">Nomor Surat</label>
						</div>
						<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
							<div class="input-group">
								<div class="form-line">
									<input type="text" id="letternumber" name="nomor_surat" class="form-control" placeholder="Masukkan Nomor Surat" required>
								</div>
							</div>
						</div>
						
						<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
							<label for="letterto">Tertuju</label>
						</div>
						<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
							<div class="input-group">
								<select class="form-control show-tick" name="penerima_id[]" data-live-search="true" id="letterto" required multiple>
									<option disabled>Pilih Tujuan Surat</option>
									@foreach ($instances as $i => $instansi)
										<option value="{{ $instansi->id }}">{{ $instansi->nama }}</option>
									@endforeach
								</select>
							</div>
						</div>
					
						<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
							<label for="letterto">Tipe Surat</label>
						</div>
						<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
							<div class="input-group">
								<select class="form-control show-tick" name="type_surat_id" data-live-search="true" id="letterto" required>
									<option disabled selected>Pilih Tipe Surat</option>
									@foreach ($types as $t => $tipe)
										<option value="{{ $tipe->id }}">{{ $tipe->nama }}</option>
									@endforeach
								</select>
							</div>
						</div>
																
						<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
							<label for="letterdate">Tanggal Surat</label>
						</div>
						<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
							<div class="input-group date" id="bs_datepicker_component_container">
								<span class="input-group-addon">
									<i class="material-icons">date_range</i>
								</span>
								<div class="form-line">
									<input type="text" id="letterdate" name="tanggal_surat" class="form-control" placeholder="Pilih Tanggal Surat" required autocomplete="off">
								</div>
							</div>
						</div>
					
						<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
							<label for="letterfile">File</label>
						</div>
						<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
							<div class="input-group">
								<input type="file" id="letterfile" name="body" class="form-control" placeholder="Pilih FILE yang akan di upload" required>
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
	
	@include('partials.footer-form')
	@include('partials.footer-table')
	@include('partials.sweetalert')
	{{-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> --}}


	<script type="text/javascript" class="init">
		$(document).ready(function() {
			$('#js-basic-example').DataTable({
				"columnDefs": [
					{ "width": "20%", "target": 2 },
					{ "width": "80px", "target": 0 }
				]
			});

			// const axios = require('axios');
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
							
							swal('Success',"Berhasil Menambahakan Data","success");	
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