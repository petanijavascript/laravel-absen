<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pengguna extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['email', 'nama', 'realpassword', 'password'];
    // protected $guarded = ['id_absensi'];
    protected $table = 'pengguna';

    public function allData()
    {
        return DB::table('pengguna')
        ->get();
    }
}
