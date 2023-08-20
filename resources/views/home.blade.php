@extends('layouts.template')
@section('css')


<style>
    .border-left-primary {
        border-left: 0.25rem solid #4e73df !important;
    }
    
    .border-left-success {
        border-left: 0.25rem solid #1cc88a !important;
    }

    .text-gray {
        color: #888a97 !important;
    }

    .text-gray-800 {
        color: #545661 !important;
    }

    .col-md-4 {
    flex: 0 0 33.33333%;
    max-width: 33.33333%;
  }
</style>

@endsection

@section('content')


<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Home</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-1">
            <div class="card border-left-primary shadow h-90 py-1">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h5 font-weight-bold text-primary text-uppercase mb-1">
                                    SISWA</div>
                                <div class="h4 mb-0 font-weight-bold text-gray-800">{{ $siswa }} Orang</div>
                            </div>
                        <div class="col-auto">
                            <i class="mdi mdi-account-group fa-4x text-gray"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-1">
            <div class="card border-left-success shadow h-90 py-1">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 font-weight-bold text-success text-uppercase mb-1">
                                PESERTA</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">{{ $peserta }} Orang</div>
                            {{-- <div class="mb-0 font-weight-bold text-gray-800"><span class="mdi mdi-account-group fa-2x text-danger "> 5 Peserta</span></div> --}}
                        </div>
                        <div class="col-auto">
                            <i class="mdi mdi-account-group fa-4x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
@endsection