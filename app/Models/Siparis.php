<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siparis extends Model
{
    use HasFactory;

    protected $table = 'siparis';

    protected $fillable = [
        'masa_id',
        'toplam_tutar',
        'durum'
    ];

    public function masa()
{
    return $this->belongsTo(Masa::class);
}

    public function detaylar()
{
    return $this->hasMany(SiparisDetay::class);
}
}