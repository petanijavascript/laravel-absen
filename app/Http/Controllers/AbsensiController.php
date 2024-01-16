<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Carbon;
use App\Models\Absensi;
use Validator;

class AbsensiController extends Controller
{
    public function __construct()
    {
        //constructor
        $this->Absensi = new Absensi();
    }

    public function index(): View
    {
        try {
            $data = [
                'absensi' => $this->Absensi
                                  ->where('email', session('email')) 
                                  ->whereMonth('waktu_masuk', Carbon::now()->month)
                                  ->whereYear('waktu_masuk', Carbon::now()->year)->get(),
            ];
            // $data = [
            //     'absensi' => $this->Absensi->where('email', session('email'))->get(),
            // ];
            return view('absensi', $data);
          
            } catch (\Exception $e) {
          
              return $e->getMessage();
            }
    }

    public function store(Request $request)
    { 
        try {
            //create post
            $this->Absensi->create([
                'email'       => $request->email,
                'waktu_masuk' => $request->waktu_masuk
            ]);

            return redirect("absensi");
          
            } catch (\Exception $e) {
          
              return $e->getMessage();
            }
    }

    public function update(Request $request)
    { 
        try {

            $masuk = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::parse($request->waktu_masuk)->format('Y-m-d').' 09:00:00'); 
            $start  = new Carbon($request->waktu_masuk);
            $end    = new Carbon($request->waktu_keluar);
            $overtime_minutes = 0;
            $lesstime_minutes = 0;
            $complete_minutes = $end->diffInMinutes($start);
            if($complete_minutes > 510) $overtime_minutes = $complete_minutes - 510;
            if(($complete_minutes > 0) && ($complete_minutes < 510)) $lesstime_minutes = 510 - $complete_minutes;

            //create post
            $this->Absensi
                ->where('id_absensi', $request->id)
                ->update([
                    'waktu_keluar' => $request->waktu_keluar,
                    'jumlah_lembur' => $overtime_minutes,
                    'selisih_kurang' => $lesstime_minutes,
                ]);

            return redirect("absensi");
          
            } catch (\Exception $e) {
          
              return $e->getMessage();
            }
    }
}
