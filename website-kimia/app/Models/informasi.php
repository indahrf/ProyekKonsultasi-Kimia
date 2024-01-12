<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;;
use Carbon\Carbon;

class informasi extends Model
{
    use HasFactory;
    protected $table = "informasi";
    protected $fillable = ['judul', 'isi', 'tipe', 'tgl_mulai', 'tgl_akhir', 'foto', 'link'];

    protected $appends = ['tgl_mulai_indo', 'tgl_akhir_indo'];

    public function getTglMulaiIndoAttribute()
    {
        return Carbon::parse($this->attributes['tgl_mulai'])->translatedFormat('d F Y');
    }

    public function getTglAkhirIndoAttribute()
    {
        if($this->attributes['tgl_akhir']){
            return Carbon::parse($this->attributes['tgl_akhir'])->translatedFormat('d F Y');
        }
        else
        {
            return 'present';
        }
    }
}