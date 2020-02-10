@extends('layouts.template')

@section('title')
Buat Surat
@endsection

@section('head-scripts')
	@include('partials.header-form')
	@include('partials.header-table')
	@include('partials.header-jquery-modal')
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
							{{ strtoupper($tipeSurat->nama) }}
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
										<th>Status</th>
		                            </tr>
		                        </thead>
		                        <tfoot>
									<tr>
                                        <th>No</th>
                                        <th>Nama Surat</th>
                                        <th>Tanggal</th>
                                        <th>Penerima</th>
                                        <th>Menu</th>
                                        <th>Status</th>
									</tr>
		                        </tfoot>
		                        <tbody>
                                    @foreach ($letter as $l => $surat)
                                        <tr>
                                        <td>{{ $l+1 }}</td>
										<td>
											<a href="{{ route('surat.detail', $surat->id) }}">{{ $surat->nomor_surat }}</a>
										</td>

										<td>{{ $surat->tanggal_surat }}</td>
										<td>
											<ol>
											@foreach ($surat->penerima as $p)
												<li>{{ $p->instansi->nama }}</li>
											@endforeach
											</ol>
										</td>
                                        <td>
											<form action="{{ route('surat.destroy', $surat->id)}}" method="post" id="js-sweetalert-{{ $surat->id }}">
												@csrf
												@method('DELETE')
												<a href="{{ route('surat.edit',$surat->id) }}">
													<button type="button" class="btn btn-success waves-effect" {{ $surat->penerima[0]->status != 'terkirim' ? 'disabled' : ''}}>
														<i class="material-icons">create</i>
													</button>
												</a>
												<button type="submit" class="btn btn-danger waves-effect" data-id="{{ $surat->id }}" onclick="swal1({{ $surat->id }})" {{ $surat->penerima[0]->status != 'terkirim' ? 'disabled' : ''}}>
													<i class="material-icons">delete</i>
												</button>
											</form>
										</td>
										<td>
											@if($surat->penerima[0]->status == 'terkirim')
												<span class="badge bg-blue">TERKIRIM</span>
											@else
												<span class="badge bg-green">DIBACA</span>
											@endif
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
			<form id="formNew" class="form-horizontal" method="POST" action="{{ route('surat.save', $pass_id) }}" enctype="multipart/form-data">
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
							<select class="form-control show-tick" name="penerima_id[]" title="Pilih Tujuan Surat" data-live-search="true" id="letterto" required multiple>
								<option disabled>Pilih Tujuan Surat</option>
								@foreach ($instances as $i => $instansi)
									@if($instansi->id !== 1 && $instansi->id !== $user->id)
									<option value="{{ $instansi->id }}">{{ $instansi->nama }}</option>
									@endif
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


<!-- Modal PDF ====================================================================================================================== -->
@endsection

@section('end-scripts')
	
	@include('partials.footer-form')
	@include('partials.footer-table')
	@include('partials.sweetalert')

	<script type="text/javascript" class="init">
		$(document).ready(function() {
			$('#js-basic-example').DataTable({
				"columnDefs": [
					{ "width": "20%", "target": 4 },
					{ "width": "10%", "target": 0 }
				]
			});

			// const axios = require('axios');
			$('#formNew').on('submit',function(e){
				e.preventDefault();
				//console.log(e.target);
				let data = new FormData($('#formNew')[0])
					swal({
					title: "Konfirmasi",
					text:"Klik Upload untuk Melanjutkan",
					type:"warning",
					showCancelButton: true,
					confirmButtonText: "Upload",
					cancelButtonText: "Batal",
					showLoaderOnConfirm: true,
					closeOnConfirm: false
					}, 
					function() {
							
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
									text:"Berhasil Menambahkan Data",
									type:"success"}, 
									function() {
											location.reload();
											} 
									);	
									$('#formNew')[0].reset();
									$('#defaultModal').modal('hide')
								}
							})
							.catch(error => {
								let errors = error;
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
							});
							} 
					);

			})
		} );
	</script>
@endsection