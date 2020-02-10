@extends('layouts.template')

@section('title')
Daftar Surat Masuk
@endsection

@section('head-scripts')
	@include('partials.header-form')
	@include('partials.header-table')
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
		                    DAFTAR SURAT MASUK
						</h2>
		            </div>
		            <div class="body">
		                <div class="table-responsive">
		                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="js-basic-example">
		                        <thead>
		                            <tr>
										<th>No</th>
		                                <th>Nama Surat</th>
										<th>Tipe Surat</th>
		                                <th>Tanggal</th>
										<th>Pengirim</th>
										<th>Status</th>
		                            </tr>
		                        </thead>
		                        <tfoot>
									<tr>
                                        <th>No</th>
                                        <th>Nama Surat</th>
                                        <th>Tipe Surat</th>
                                        <th>Tanggal</th>
                                        <th>Pengirim</th>
                                        <th>Status</th>
									</tr>
		                        </tfoot>
		                        <tbody>
                                    @foreach ($inbox as $l => $surat)
                                        <tr>
                                        <td>{{ $l+1 }}</td>
										<td>
											<a href="{{ route('surat.detail', $surat->surat_id) }}">
												{{ $surat->surat->nomor_surat }}
											</a>
										</td>
										<td>{{ $surat->surat->tipesurat->nama }}</td>
										<td>{{ $surat->surat->tanggal_surat }}</td>
										<td>{{ strtoupper($surat->surat->pengirim->nama) }}</td>
										{{-- <td>{{ $surat->status == 'terkirim' ? 'baru' : 'dibuka' }}</td> --}}
										<td>
											@if($surat->status == 'terkirim')
												<span class="badge bg-blue">BARU</span>
												@else
												<span class="badge bg-green">DIBACA</span>
											@endif
										</td>
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
					{ "width": "20%", "target": 4 },
					{ "width": "10%", "target": 0 }
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