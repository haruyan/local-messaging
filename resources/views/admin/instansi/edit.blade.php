@extends('layouts.template')

@section('title')
Edit Instansi
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
		                    Edit Instansi
						</h2>
		            </div>
		            <div class="body">
						<form class="form-horizontal" method="POST" action="{{ route('instansi.update', $instance->id) }}">
								@method('PATCH') 
								@csrf
		                    <div class="row clearfix">
		                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
		                            <label for="nama-instansi">Nama Instansi</label>
		                        </div>
		                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
		                            <div class="input-group">
		                                <div class="form-line">
		                                    <input type="text" id="nama-instansi" class="form-control" placeholder="Masukkan Nomor Surat" name="nama" value="{{ $instance->nama }}" required autofocus>
		                                </div>
		                            </div>
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
@endsection