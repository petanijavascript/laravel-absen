<?php

namespace App\Http\Controllers;

// use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengguna;
use Validator;

class LoginController extends Controller
{
    public function __construct()
    {
        //constructor
        $this->Pengguna = new Pengguna();
    }

    public function index(): View
    {
        try {

            return view('login');
          
            } catch (\Exception $e) {
          
              return $e->getMessage();
            }
    }

    public function authenticate(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $pengguna = $this->Pengguna->where('email', $request->email)->first();
            session(['email' => $pengguna->email, 'nama' => $pengguna->nama]);
 
            return redirect()->intended('dashboard');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }

}
