<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Carbon;
use App\Models\Absensi;
use Illuminate\Support\Facades\DB;
use Validator;

class RekapController extends Controller
{
    public function __construct()
    {
        $this->Absensi = new Absensi();
    }

    public function index(): View
    {
        try {
            $data = [
                'absensi' => $this->Absensi->where('email', session('email'))->get(),
                'distinyear' => $this->Absensi->select(DB::raw('YEAR(waktu_masuk) year'))
                ->distinct()->where('email', session('email'))->get(),
                'distinmonth' => $this->Absensi->select(DB::raw('MONTH(waktu_masuk) month, MONTHNAME(waktu_masuk) month_name'))
                ->distinct()->where('email', session('email'))->get(),
                'years' => 0,
                'months' => 0,
            ];
            return view('rekap', $data);
          
            } catch (\Exception $e) {
          
              return $e->getMessage();
            }
    }

    public function show(Request $request)
    {
        try {
            if(($request->year > 0) && ($request->month > 0)) $query = $this->Absensi->where('email', session('email'))->whereYear('waktu_masuk', $request->year)->whereMonth('waktu_masuk', $request->month)->orderBy('waktu_masuk', 'asc')->get();
            if(($request->year > 0) && ($request->month == 0)) $query = $this->Absensi->where('email', session('email'))->whereYear('waktu_masuk', $request->year)->orderBy('waktu_masuk', 'asc')->get();
            if(($request->year == 0) && ($request->month == 0)) $query = $this->Absensi->where('email', session('email'))->whereYear('waktu_masuk', Carbon::now()->format('Y'))->whereMonth('waktu_masuk', Carbon::now()->format('m'))->orderBy('waktu_masuk', 'asc')->get();
            $data = [
                'absensi' => $query,
                'distinyear' => $this->Absensi->select(DB::raw('YEAR(waktu_masuk) year'))
                ->distinct()->where('email', session('email'))->get(),
                'distinmonth' => $this->Absensi->select(DB::raw('MONTH(waktu_masuk) month, MONTHNAME(waktu_masuk) month_name'))
                ->distinct()->where('email', session('email'))->get(),
                'years' => $request->year,
                'months' => $request->month,
            ];
            return view('rekap', $data);
          
            } catch (\Exception $e) {
          
              return $e->getMessage();
            }
    }
}
