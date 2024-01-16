<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'waktu_masuk'];
    protected $guarded = ['id_absensi'];
    protected $table = 'absensi';

    public function allData()
    {
        return DB::table('absensi')
        ->get();
    }
}
