<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sepet extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'adet',
        'fiyat'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}