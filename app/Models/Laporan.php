<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $konfirmasi_dinas = [true , false];


    public function user(){
        return $this->belongsTo(User::class);
    }
    public function kategoriLapor(){
        return $this->belongsTo(Kategori::class);
    }
    public function statusLapor(){
        return $this->belongsTo(Status::class);
    }
}
