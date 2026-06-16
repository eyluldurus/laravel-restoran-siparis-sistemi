<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siparis;
use App\Models\Menu;
use App\Models\SiparisDetay;

class SiparisController extends Controller
{
    public function dashboard()
{
    $toplamUrun = Menu::count();

    $toplamSiparis = Siparis::count();

    $bekleyen = Siparis::where('durum', 'Bekliyor')->count();

    $hazirlaniyor = Siparis::where('durum', 'Hazırlanıyor')->count();

    $hazir = Siparis::where('durum', 'Hazır')->count();

    $teslim = Siparis::where('durum', 'Teslim Edildi')->count();

    $toplamCiro = Siparis::sum('toplam_tutar');

    $enCokSatilan = SiparisDetay::selectRaw('menu_id, SUM(adet) as toplam_adet')
    ->groupBy('menu_id')
    ->orderByDesc('toplam_adet')
    ->with('menu')
    ->first();

    return view('dashboard', compact(
    'toplamUrun',
    'toplamSiparis',
    'bekleyen',
    'hazirlaniyor',
    'hazir',
    'teslim',
    'toplamCiro',
    'enCokSatilan'
));
}

    public function index()
    {
        $siparisler = Siparis::with(['masa', 'detaylar.menu'])
    ->orderBy('id', 'desc')
    ->get();

        return view('siparisler', compact('siparisler'));
    }

    public function durumGuncelle(Request $request, $id)
{
    $siparis = Siparis::findOrFail($id);

    $siparis->durum = $request->durum;

    $siparis->save();

    return redirect('/siparisler');
}

public function sil($id)
{
    $siparis = Siparis::findOrFail($id);

    $siparis->detaylar()->delete();

    $siparis->delete();

    return redirect('/siparisler');
}
}