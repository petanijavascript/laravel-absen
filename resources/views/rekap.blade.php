@extends('layout.template')

@section('title')
Absensi
@endsection
@section('heading')
Rekap
@endsection
@section('content')
<div class="col-12">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Attendance Report</h6>
    </div>
    <div class="card-body">
        <div class="div col-lg-12" style="height: 50px;">
            <form action="/rekap/show" method="POST">
                @csrf
                <select class="select" name="year" required>
                    <option value="0" selected>- Silahkan Pilih Tahun -</option>
                    @foreach($distinyear as $data)
                    <option value="{{ $data->year }}" @if($data->year==$years) {{ 'selected' }} @endif>{{ $data->year }}</option>
                    @endforeach
                </select>
                <select class="select" name="month" required>
                    <option value="0" selected>- Silahkan Pilih Bulan -</option>
                    @foreach($distinmonth as $data)
                        <option value="{{ $data->month }}" @if($data->month==$months) {{ 'selected' }} @endif>{{ $data->month_name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary"style="vertical-align: middle">Show</button>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>IN</th>
                        <th>OUT</th>
                        <th>Working Time</th>
                        <th>Overtime</th>
                    </tr>
                </thead>
                @foreach($absensi as $data)
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
                    $completetime = floor($complete_minutes / 60).' jam '.($complete_minutes -   floor($complete_minutes / 60) * 60)." menit";
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
                        <td><span class="text">{{ $completetime }}</span></td>
                        <td>
                            @if ($overtime_minutes > 0)
                            <span class="btn btn-success text-center" style="font-size: 14px; font-weight: 700">Lembur<br>{{ $overtime }}</span>
                            @elseif ($lesstime_minutes > 0)
                            <span class="btn btn-warning text-center" style="font-size: 14px; font-weight: 700">Kurang<br>{{ $lesstime }}</span>
                            @else
                            <span class="text">0</span>
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
