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
		                    BASIC EXAMPLE
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
		                <div class="table-responsive">
		                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="js-basic-example">
		                        <thead>
		                            <tr>
		                                <th>Nomor</th>
		                                <th>Nama Surat</th>
		                                <th>Tanggal</th>
		                                <th>Penerima</th>
		                                <th>Menu</th>
		                            </tr>
		                        </thead>
		                        <tfoot>
		                            <tr>
		                                <th>Nomor</th>
		                                <th>Nama Surat</th>
		                                <th>Tanggal</th>
		                                <th>Pnerima</th>
		                                <th>Menu</th>
		                            </tr>
		                        </tfoot>
		                        <tbody>
		                            <tr>
		                                <td>1</td>
		                                <td>System Architect</td>
		                                <td>Edinburgh</td>
		                                <td>
		                                	<button type="button" class="btn btn-success waves-effect">
        	                                    <i class="material-icons">visibility</i>
        	                                </button>
		                                	<button type="button" class="btn btn-info waves-effect">
        	                                    <i class="material-icons">create</i>
        	                                </button>
		                                	<button type="button" class="btn btn-danger waves-effect">
        	                                    <i class="material-icons">delete</i>
        	                                </button>
		                                </td>
		                            </tr>
		                            <tr>
		                                <td>2</td>
		                                <td>Accountant</td>
		                                <td>Tokyo</td>
		                                <td>
		                                	<button type="button" class="btn btn-success waves-effect">
        	                                    <i class="material-icons">visibility</i>
        	                                </button>
		                                	<button type="button" class="btn btn-info waves-effect">
        	                                    <i class="material-icons">create</i>
        	                                </button>
		                                	<button type="button" class="btn btn-danger waves-effect">
        	                                    <i class="material-icons">delete</i>
        	                                </button>
        	                            </td>
		                            </tr>
		                            <tr>
		                                <td>3</td>
		                                <td>Junior Technical Author</td>
		                                <td>San Francisco</td>
		                                <td>
		                                	<button type="button" class="btn btn-success waves-effect">
        	                                    <i class="material-icons">visibility</i>
        	                                </button>
		                                	<button type="button" class="btn btn-info waves-effect">
        	                                    <i class="material-icons">create</i>
        	                                </button>
		                                	<button type="button" class="btn btn-danger waves-effect">
        	                                    <i class="material-icons">delete</i>
        	                                </button>
        	                            </td>
		                            </tr>
		                            <tr>
		                                <td>4</td>
		                                <td>Senior Javascript Developer</td>
		                                <td>Edinburgh</td>
		                                <td>
		                                	<button type="button" class="btn btn-success waves-effect">
        	                                    <i class="material-icons">visibility</i>
        	                                </button>
		                                	<button type="button" class="btn btn-info waves-effect">
        	                                    <i class="material-icons">create</i>
        	                                </button>
		                                	<button type="button" class="btn btn-danger waves-effect">
        	                                    <i class="material-icons">delete</i>
        	                                </button>
        	                            </td>
		                            </tr>
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
    @include('partials.footer-table')
@endsection