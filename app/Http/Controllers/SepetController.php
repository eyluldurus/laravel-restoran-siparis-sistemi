<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sepet;
use App\Models\Menu;
use App\Models\Siparis;
use App\Models\SiparisDetay;

class SepetController extends Controller
{
    public function index()
{
    $sepetler = Sepet::with('menu')->get();

    $toplam = 0;

    foreach ($sepetler as $sepet) {
        $toplam += $sepet->fiyat * $sepet->adet;
    }

    return view('sepet', compact('sepetler', 'toplam'));
}

    public function ekle($id)
{
    $menu = Menu::findOrFail($id);

    $sepet = Sepet::where('menu_id', $id)->first();

    if ($sepet) {

        $sepet->adet += 1;
        $sepet->save();

    } else {

        Sepet::create([
            'menu_id' => $menu->id,
            'adet' => 1,
            'fiyat' => $menu->fiyat
        ]);
    }

    return redirect('/sepet');
}

public function sil($id)
{
    $sepet = Sepet::findOrFail($id);

    $sepet->delete();

    return redirect('/sepet');
}

public function siparisVer()
{
    $sepetler = Sepet::all();

    if ($sepetler->count() == 0) {
        return redirect('/sepet');
    }

    $toplam = 0;

    foreach ($sepetler as $sepet) {
        $toplam += $sepet->fiyat * $sepet->adet;
    }

    $siparis = Siparis::create([
    'masa_id' => session('masa_id', 1),
    'toplam_tutar' => $toplam,
    'durum' => 'Bekliyor'
    ]);

    foreach ($sepetler as $sepet) {

        SiparisDetay::create([
            'siparis_id' => $siparis->id,
            'menu_id' => $sepet->menu_id,
            'adet' => $sepet->adet,
            'fiyat' => $sepet->fiyat
        ]);
    }

    Sepet::truncate();

    return redirect('/sepet')->with('basarili', 'Siparişiniz başarıyla oluşturuldu.');
}
}