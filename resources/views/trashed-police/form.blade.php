@extends('layouts.template')

@section('headscripts33333')
<script type="text/javascript" class="init">
  $(document).ready(function() {
	// jQuery(document).ready(function($){
	  $('#js-basic-example').DataTable( {
	    "order": [[ 0, "desc" ]]
	  } );
	} );
</script>
@endsection

@section('title')
Daftar Surat
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
		                    HORIZONTAL LAYOUT
		                </h2>
		            </div>
		            <div class="body">
		                <form class="form-horizontal">
		                    <div class="row clearfix">
		                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
		                            <label for="letternumber">Nomor Surat</label>
		                        </div>
		                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
		                            <div class="input-group">
		                                <div class="form-line">
		                                    <input type="text" id="letternumber" class="form-control" placeholder="Masukkan Nomor Surat" required>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                    <div class="row clearfix">
		                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
		                            <label for="letterdate">Tanggal Surat</label>
		                        </div>
		                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
		                            <div class="input-group date" id="bs_datepicker_component_container">
                                        <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
		                                <div class="form-line">
		                                    <input type="text" id="letterdate" class="form-control" placeholder="Pilih Tanggal Surat" required>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                    <div class="row clearfix">
		                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
		                            <label for="letterto">Tertuju</label>
		                        </div>
		                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <select class="form-control show-tick" data-live-search="true" id="letterto" required>
                                    	<option disabled selected>Pilih Tujuan Surat</option>
                                        <option>Keadilan Negeri</option>
                                        <option>Kejaksaan</option>
                                        <option>Lapas</option>
                                    </select>
		                        </div>
		                    </div>
		                    <div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<label for="letterfile">File</label>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="input-group">
										<input type="file" id="letterfile" class="form-control" placeholder="Pilih FILE yang akan di upload" required>
									</div>
								</div>
							</div>
		                    <div class="row clearfix">
		                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
		                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPLOAD</button>
		                        </div>
		                    </div>
						</form>
		            </div>
		        </div>
		    </div>
		</div>

		<!-- File Upload | Drag & Drop OR With Click & Choose -->
		<div class="row clearfix">
		    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		        <div class="card">
		            <div class="header">
		                <h2>
		                    FILE UPLOAD - DRAG & DROP OR WITH CLICK & CHOOSE
		                    <small>Taken from <a href="http://www.dropzonejs.com/" target="_blank">www.dropzonejs.com</a></small>
		                </h2>
		                <ul class="header-dropdown m-r--5">
		                    <li class="dropdown">
		                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
		                            <i class="material-icons">more_vert</i>
		                        </a>
		                        <ul class="dropdown-menu pull-right">
		                            <li><a href="javascript:void(0);">Action</a></li>
		                            <li><a href="javascript:void(0);">Another action</a></li>
		                            <li><a href="javascript:void(0);">Something else here</a></li>
		                        </ul>
		                    </li>
		                </ul>
					</div>
					
		            <div class="body">
		                <form action="/" id="frmFileUpload" class="dropzone" method="post" enctype="multipart/form-data">
		                    <div class="dz-message">
		                        <div class="drag-icon-cph">
		                            <i class="material-icons">touch_app</i>
		                        </div>
		                        <h3>Drop files here or click to upload.</h3>
								<em>(This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.)</em>
							</div>
		                    <div class="fallback">
		                        <input name="file" type="file" multiple />
		                    </div>
		                </form>
		            </div>
		        </div>
		    </div>
		</div>
		<!-- #END# File Upload | Drag & Drop OR With Click & Choose -->
	</div>	
</section>
@endsection

@section('end-scripts')
	@include('partials.footer-form')
@endsection