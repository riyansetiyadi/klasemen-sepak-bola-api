<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPertandingan extends Model
{
    use HasFactory;

    protected $fillable = [
        'klub_tuan_rumah_id',
        'klub_tamu_id',
        'skor_tuan_rumah',
        'skor_tamu',
    ];
}
