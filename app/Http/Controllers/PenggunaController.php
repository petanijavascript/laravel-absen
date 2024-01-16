<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class PenggunaController extends Controller
{
    public function __construct()
    {
        //constructor
        $this->Pengguna = new Pengguna();
    }

    public function index(): View
    {
        try {

            $data = [
                'pengguna' => $this->Pengguna->whereNull('deleted_at',)->get(),
            ];
            return view('register', $data);
          
            } catch (\Exception $e) {
          
              return $e->getMessage();
            }
    }

    public function store(Request $request)
    { 
        try {
            $hashpassword = Hash::make($request->password);
            //create post
            $this->Pengguna->create([
                'email'    => $request->email,
                'nama'     => $request->nama,
                'realpassword' => $request->password,
                'password' => $hashpassword
            ]);

            return redirect("register");
          
            } catch (\Exception $e) {
          
              return $e->getMessage();
            }
    }

    public function update(Request $request)
    { 
        try {

            $hashpassword = Hash::make($request->password);
            //create post
            $this->Pengguna
                ->where('email', $request->email)
                ->update([
                    'nama' => $request->nama,
                    'realpassword' => $request->password,
                    'password' => $hashpassword
                ]);

            return redirect("register");
          
            } catch (\Exception $e) {
          
              return $e->getMessage();
            }
    }

    public function delete(Request $request)
    { 
        try {

            //create post
            $this->Pengguna
                ->where('email', $request->email)
                ->update([
                    'deleted_at' => Carbon::now()
                ]);

            // Pengguna::where('email', $request->email)->delete();

            return response()->json(['success'=>'Data deleted successfully.']);
          
            } catch (\Exception $e) {
          
              return $e->getMessage();
            }
    }
}
