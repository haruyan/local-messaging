@extends('layouts.template')

@section('title')
Edit Tipe Surat
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
		                    Edit Tipe Surat
						</h2>
		            </div>
		            <div class="body">
						<form class="form-horizontal" method="POST" action="{{ route('tipe-surat.update', $tipe->id) }}" id="formNew">
								@method('PATCH') 
								@csrf
		                    <div class="row clearfix">
		                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
		                            <label for="nama-tipe">Nama Tipe Surat</label>
		                        </div>
		                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
		                            <div class="input-group">
		                                <div class="form-line">
		                                    <input type="text" id="nama-tipe" class="form-control" placeholder="Masukkan Nomor Surat" name="nama" value="{{ $tipe->nama }}" required autofocus>
		                                </div>
		                            </div>
		                        </div>
							</div>
							
							<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
								<label for="role">Instansi</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
								<select name="instansi_id" data-live-search="true" class="form-control show-tick">
									<option value="">Pilih Instansi</option>
									@foreach($instansi as $item)
										<option value="{{ $item->id }}" {{ $tipe->instansi_id == $item->id ? 'selected' : '' }}>{{ strtoupper($item->nama) }}</option>
									@endforeach
								</select>
							</div>

							<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="icon">Ikon</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="input-group">
                                    <input type="file" id="icon" name="icon" class="form-control">
                                    <br>{{ $tipe->icon }}
                                </div>
                            </div>

		                    <div class="row clearfix">
		                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
									<button type="submit" class="btn btn-primary m-t-15 waves-effect">Simpan</button>
									<a href="{{ url()->previous() }}">
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