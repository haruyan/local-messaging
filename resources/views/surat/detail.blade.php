@extends('layouts.template')

@section('title')
Detail Surat
@endsection

@section('head-scripts')
	@include('partials.header-form')
	@include('partials.header-table')
	@include('partials.header-jquery-modal')
@endsection


@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-3">
                <div class="card card-about-me">
                    <div class="header">
                        <h2>Detail Surat</h2>
                    </div>
                    <div class="body">
                        <ul>
                            <li>
                                <div class="title">
                                    <i class="material-icons">attachment</i>
                                    Nomor Surat
                                </div>
                                <div class="content">
                                    {{ $letter->nomor_surat }}
                                </div>
                            </li>
                            <li>
                                <div class="title">
                                    <i class="material-icons">person</i>
                                    Pengirim
                                </div>
                                <div class="content">
                                    {{ strtoupper($letter->pengirim->nama) }}
                                </div>
                            </li>
                            <li>
                                <div class="title">
                                    <i class="material-icons">people</i>
                                    Penerima
                                </div>
                                <div class="content">
                                    <ol style="display:block">
                                        @foreach ($letter->penerima as $penerima)
                                            <li>{{ strtoupper($penerima->instansi->nama) }}</li>
                                        @endforeach
                                    </ol>
                                </div>
                            </li>
                            <li>
                                <div class="title">
                                    <i class="material-icons">more</i>
                                    Tipe Surat
                                </div>
                                <div class="content">
                                        {{ strtoupper($letter->tipesurat->nama) }}
                                </div>
                            </li>
                            <li>
                                <div class="title">
                                    <i class="material-icons">date_range</i>
                                    Dikirim Pada
                                </div>
                                <div class="content">
                                        {{ ($letter->tanggal_surat) }}
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-9">
                <div class="card">
                    <div class="body">
                        <div class="title">
                            <i class="material-icons">insert_drive_file</i>
                            Dokumen
                        </div>
                        <div class="content m-t-30">
                            @if($extension == 'pdf')
                            <iframe class="pdf-viewer" src="/{{ $letter->body }}"></iframe>
                            @else
<!--                             <iframe style="width:100%; height:700px;" src="https://docs.google.com/gview?url={{ url($letter->body) }}&embedded=true"></iframe>             -->
                           <iframe style="width:100%; height:700px;" src="https://view.officeapps.live.com/op/embed.aspx?src={{ url($letter->body) }}"></iframe>
                         
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@section('end-scripts')
	@include('partials.footer-form')
	@include('partials.sweetalert')
@endsection