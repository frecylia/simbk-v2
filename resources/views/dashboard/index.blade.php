@extends('layouts.admin.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="content-header">
        <h1>Dashboard {{Auth::user()->roles[0]?->name ?? ''}}</h1>
    </div>
    <div class="row">
        @if(Auth::user()->hasRole('Admin'))
        <div class="col-md-4">
            <div class="card dashboard-card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Siswa</h5>
                            <h2 class="mb-0">{{$totalSiswa}}</h2>
                        </div>
                        <div class="card-icon bg-light text-primary rounded">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card dashboard-card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Semua Konseling</h5>
                            <h2 class="mb-0">{{$totalAllKonseling}}</h2>
                        </div>
                        <div class="card-icon bg-light text-primary rounded">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card dashboard-card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Konseling Aktif</h5>
                            <h2 class="mb-0">{{$totalKonseling}}</h2>
                        </div>
                        <div class="card-icon bg-light text-primary rounded">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    
</div>
@endsection

@section('css')
<style>
    .icon-spacing {
        margin-right: 15px !important;
        /* Pastikan margin diterapkan dengan benar */
    }
</style>
@endsection
