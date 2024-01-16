<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Carbon;
use App\Models\Absensi;
use Validator;

class DashboardController extends Controller
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
                'month_name' => Carbon::now()->format('F'),
            ];
            return view('dashboard', $data);
          
            } catch (\Exception $e) {
          
              return $e->getMessage();
            }
    }
}
