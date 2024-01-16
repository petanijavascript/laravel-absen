@extends('layout.template')

@section('title')
Dashboard
@endsection
@section('heading')
Dashboard
@endsection
@section('content')
 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Working Time ({{ $month_name }})</div>
                        @php
                            $overtime = 0;
                            $completetime = 0;
                        @endphp
                        @foreach($absensi->sortByDesc('waktu_masuk') as $data)
                        @php
                            $start  = new Carbon($data->waktu_masuk);
                            $end    = new Carbon($data->waktu_keluar);  
                            $masuk = Carbon::createFromFormat('Y-m-d H:i:s', $start->format('Y-m-d').' 09:00:00');
                            $overtime_minutes = 0;
                            $lesstime_minutes = 0;
                            if($start > $masuk)
                            {
                                $complete_minutes = $end->diffInMinutes($start);
                            }
                            else {
                                    $complete_minutes = $end->diffInMinutes($masuk);
                                 }
                            if($complete_minutes > 510) $overtime_minutes = $complete_minutes - 510;
                            if($complete_minutes < 510) $lesstime_minutes = 510 - $complete_minutes;
                            if($data->jumlah_lembur > 0) $overtime_minutes = $data->jumlah_lembur;
                            if($data->selisih_kurang > 0) $lesstime_minutes = $data->selisih_kurang;
                            $overtime = $overtime + $overtime_minutes;
                            $completetime = $completetime + $complete_minutes;
                        @endphp
                        @endforeach
                        @php    
                            $overtime = floor($overtime / 60).' jam '.($overtime -   floor($overtime / 60) * 60)." menit";
                            $completetime = floor($completetime / 60).' jam '.($completetime -   floor($completetime / 60) * 60)." menit";
                        @endphp
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $completetime }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Lembur ({{ $month_name }})</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $overtime }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection