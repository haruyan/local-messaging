@extends('layouts.template')

@section('title')
Tipe Surat
@endsection

@section('head-scripts')
    @include('partials.header-table')
    @include('partials.header-form')
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
		                    DAFTAR TIPE SURAT
						</h2>
						<ul class="header-dropdown">
							<button type="button" class="btn bg-blue m-r-15 waves-effect" data-toggle="modal" data-target="#defaultModal">
								<i class="material-icons">add</i>
								<span>TAMBAH TIPE SURAT</span>
							</button>
		                </ul>
		            </div>
		            <div class="body">
		                <div class="table-responsive">
		                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="js-basic-example">
		                        <thead>
		                            <tr>
		                                <th>Nomor</th>
		                                <th>Nama Instansi</th>
		                                <th>Tipe Surat</th>
		                                <th>Ikon</th>
		                                <th>Menu</th>
		                            </tr>
		                        </thead>
		                        <tfoot>
		                            <tr>
		                                <th>Nomor</th>
		                                <th>Nama Instansi</th>
		                                <th>Tipe Surat</th>
		                                <th>Ikon</th>
		                                <th>Menu</th>
		                            </tr>
		                        </tfoot>
		                        <tbody>
                                    @foreach ($tipe as $i => $tipesurat)
                                        <tr>
                                        <td>{{ $i+1 }}</td>
                                        <td>{{ strtoupper($tipesurat->instansi->nama) }}</td>
                                        <td>{{ $tipesurat->nama }}</td>
                                        <td><img class="img-tipesurat" src="{{ $tipesurat->icon }}" alt="ikon"></td>
                                        <td>
											<form action="{{ route('tipe-surat.destroy', $tipesurat->id)}}" method="post" id="js-sweetalert-{{ $tipesurat->id }}">
												@csrf
												@method('DELETE')
												<a href="{{ route('tipe-surat.edit',$tipesurat->id) }}">
													<button type="button" class="btn btn-success waves-effect">
														<i class="material-icons">create</i>
													</button>
												</a>
												<button type="submit" class="btn btn-danger waves-effect" data-id="{{ $tipesurat->id }}" onclick="swal1({{$tipesurat->id}})">
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
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel">TAMBAH TIPE SURAT</h4>
			</div>
			<form id="formNew" class="form-horizontal" method="POST" action="{{ route('tipe-surat.store') }}">
				@csrf
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
					<label for="nama-instansi">Nama Tipe Surat</label>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
					<div class="input-group">
						<div class="form-line">
							<input type="text" id="nama-instansi" class="form-control" placeholder="Masukkan Nama Tipe Surat" name="nama" required autofocus>
						</div>
					</div>
				</div>
				
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
					<label for="nama-instansi">Instansi</label>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
					<div class="input-group">
						<select name="instansi_id" data-live-search="true" class="form-control show-tick">
							<option disabled selected>Pilih Instansi</option>
							@foreach($instansi as $item)
								<option value="{{ $item->id }}">{{ strtoupper($item->nama) }}</option>
							@endforeach
						</select>
					</div>
				</div>
				
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
					<label for="icon">Ikon</label>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
					<div class="input-group">
						<input type="file" id="icon" name="icon" class="form-control" required>
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
{{-- End Modal Dialog --}}
@endsection

@section('end-scripts')
	@include('partials.footer-table')
	@include('partials.footer-form')
	@include('partials.sweetalert')
	{{-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> --}}

	<script type="text/javascript" class="init">
	$(document).ready(function() {
		$('#js-basic-example').DataTable( {
			"columnDefs": [
				{ "width": "20%", "targets": 4 },
				{ "width": "5%", "targets": 0 }
			]
		} );
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
									window.location = "/tipe-surat";
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