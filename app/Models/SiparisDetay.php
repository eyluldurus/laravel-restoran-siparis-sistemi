<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiparisDetay extends Model
{
    use HasFactory;

    protected $table = 'siparis_detays';

    protected $fillable = [
        'siparis_id',
        'menu_id',
        'adet',
        'fiyat'
    ];

    public function menu()
{
    return $this->belongsTo(Menu::class);
}
}