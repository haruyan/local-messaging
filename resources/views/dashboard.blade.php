@extends('layouts.template')

@section('title')
Dashboard
@endsection

@section('content')

<section class="content">
    <div class="container-fluid">
        <!-- Hover Expand Effect -->
        <div class="block-header">
            <h2>Pilih Menu</h2>
        </div>
        <div class="row">
            @foreach ($menu as $menu_dashboard)
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <a class="deco" href="{{ route('surat.show', $menu_dashboard->id) }}">
                        <div class="info-box-2 bg-red hover-expand-effect">
                            <img class="img-dashboard" src="{{ $menu_dashboard->icon }}">
                            <div class="content">
                                <div class="text">{{ $menu_dashboard->nama }}</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            
        </div>
        <!-- #END# Hover Expand Effect -->
    </div>
</section>

@endsection