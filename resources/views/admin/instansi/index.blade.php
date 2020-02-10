@extends('layouts.template')

@section('title')
Admin Instansi
@endsection

@section('head-scripts')
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
		                    DAFTAR INSTANSI
						</h2>
						<ul class="header-dropdown">
							<button type="button" class="btn bg-blue m-r-15 waves-effect" data-toggle="modal" data-target="#defaultModal">
								<i class="material-icons">add</i>
								<span>TAMBAH INSTANSI</span>
							</button>
		                </ul>
		            </div>
		            <div class="body">
		                <div class="table-responsive">
		                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="js-basic-example">
		                        <thead>
		                            <tr>
		                                <th>Nomor</th>
		                                <th>Jenis Instansi</th>
		                                <th>Menu</th>
		                            </tr>
		                        </thead>
		                        <tfoot>
		                            <tr>
		                                <th>Nomor</th>
		                                <th>Jenis Instansi</th>
		                                <th>Menu</th>
		                            </tr>
		                        </tfoot>
		                        <tbody>
                                    @foreach ($instances as $i => $instance)
                                        <tr>
                                        <td>{{ $i+1 }}</td>
                                        <td>{{ $instance->nama }}</td>
                                        <td>
											<form action="{{ route('instansi.destroy', $instance->id)}}" method="post" id="js-sweetalert-{{ $instance->id }}">
												@csrf
												@method('DELETE')
												<a href="{{ route('instansi.edit',$instance->id) }}">
													<button type="button" class="btn btn-success waves-effect">
														<i class="material-icons">create</i>
													</button>
												</a>
												<button type="submit" class="btn btn-danger waves-effect" data-id="{{ $instance->id }}" onclick="swal1({{$instance->id}})">
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
				<h4 class="modal-title" id="defaultModalLabel">TAMBAH INSTANSI</h4>
			</div>
			<form class="form-horizontal" method="POST" action="{{ route('instansi.store') }}">
				@csrf
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
					<label for="nama-instansi">Nama Instansi</label>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
					<div class="input-group">
						<div class="form-line">
							<input type="text" id="nama-instansi" class="form-control" placeholder="Masukkan Nama Instansi" name="nama" required autofocus>
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
	@include('partials.footer-table')
	@include('partials.sweetalert')

	<script type="text/javascript" class="init">
	$(document).ready(function() {
	$('#js-basic-example').DataTable( {
		"columnDefs": [
			{ "width": "20%", "targets": 2 },
			{ "width": "10%", "targets": 0 }
		]
	} );
	} );
	</script>
@endsection