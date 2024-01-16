@extends('layout.template')

@section('title')
Absensi
@endsection
@section('heading')
Absensi
@endsection
@section('content')
<div class="col-12">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Attendance {{ Carbon::now()->format('l\, jS \of F Y') }} (09:00 - 17:30)</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>IN</th>
                        <th>OUT</th>
                        <th>Overtime</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @if (count($absensi)==0)
                    <tr>
                        <td>
                            {{ Carbon::now()->format('d-m-Y') }}
                        </td>
                        <td>--:--:--</td>
                        <td>--:--:--</td>
                        <td>0</td>
                        <td>
                            <form action="/absensi/store" method="POST">
                                @csrf
                                <input type="hidden"  name="email" value="aldry@gmail.com">
                                <input type="hidden"  name="waktu_masuk" value="{{ Carbon::now()->format("Y-m-d H:i:s"); }}">
                                <button type="submit" class="btn btn-success btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                    <span class="text">Clock IN</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endif
                @foreach($absensi->sortByDesc('waktu_masuk') as $data)
                @if ($loop->first)
                    @if (Carbon::now()->format('d-m-Y') != Carbon::parse($data->waktu_masuk)->format('d-m-Y'))
                    <tr>
                        <td>
                            {{ Carbon::now()->format('d-m-Y') }}
                        </td>
                        <td>--:--:--</td>
                        <td>--:--:--</td>
                        <td>0</td>
                        <td>
                            <form action="/absensi/store" method="POST">
                                @csrf
                                <input type="hidden"  name="email" value="fujhi@gmail.com">
                                <input type="hidden"  name="waktu_masuk" value="{{ Carbon::now()->format("Y-m-d H:i:s") }}">
                                <button type="submit" class="btn btn-success btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                    <span class="text">Clock IN</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endif
                @endif
                @endforeach
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
                    $overtime = floor($overtime_minutes / 60).' jam '.($overtime_minutes -   floor($overtime_minutes / 60) * 60)." menit";
                    $lesstime = floor($lesstime_minutes / 60).' jam '.($lesstime_minutes -   floor($lesstime_minutes / 60) * 60)." menit";
                @endphp
                    @if (!empty($data->waktu_masuk))
                    <tr>
                        <td>
                            {{ $start->format('d-m-Y') }}
                        </td>
                        <td>
                            @if ($start > $masuk)
                            <span class="btn btn-danger text-center" style="font-size: 14px; font-weight: 700">Late <br>{{ $start->format('H:i:s') }}</span>
                            @elseif ($start < $masuk)
                            <span class="btn btn-success text-center" style="font-size: 14px; font-weight: 700">Early <br>{{ $start->format('H:i:s') }}</span>
                            @else
                            {{ $start->format('H:i:s') }}
                            @endif
                        </td>
                        <td>
                            @if (!empty($data->waktu_keluar))
                            {{ $end->format('H:i:s') }}
                            @else
                            --:--:--
                            @endif
                        </td>
                        <td>
                            @if ($overtime_minutes > 0)
                            <span class="btn btn-success text-center" style="font-size: 14px; font-weight: 700">Lembur<br>{{ $overtime }}</span>
                            @elseif ($lesstime_minutes > 0)
                            <span class="btn btn-warning text-center" style="font-size: 14px; font-weight: 700">Kurang<br>{{ $lesstime }}</span>
                            @else
                            <span class="text">0</span>
                            @endif
                        </td>
                        <td>
                            @if ($complete_minutes >= 510)
                                <span class="icon" style="font-weight: bold; color: rgb(13, 198, 13);">
                                    <i class="fas fa-check"></i>
                                </span>
                                <span class="text" style="font-weight: bold; color: rgb(13, 198, 13);">Complete</span>
                            @elseif ($start->format('Y-m-d') != Carbon::now()->format('Y-m-d'))
                                <span class="icon" style="font-weight: bold; color: rgb(222, 52, 13);">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </span>
                                <span class="text" style="font-weight: bold; color: rgb(222, 52, 13);">Not Complete</span>
                            @else 
                                <form action="/absensi/update" method="POST">
                                @csrf
                                <input type="hidden"  name="id" value="{{ $data->id_absensi }}">
                                <input type="hidden"  name="waktu_masuk" value="{{ $start }}">
                                <input type="hidden"  name="waktu_keluar" value="{{ Carbon::now()->format("Y-m-d H:i:s") }}">
                                <button type="submit" class="btn btn-primary btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-minus"></i>
                                    </span>
                                    <span class="text">Clock OUT</span>
                                </button>
                            </form>
                            @endif 
                        </td>
                    </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>
@endsection
