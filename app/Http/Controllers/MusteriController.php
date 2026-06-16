<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MusteriController extends Controller
{
    public function index(Request $request)
{
    if ($request->masa) {
    session(['masa_id' => $request->masa]);
}

    $query = Menu::query();

    if ($request->kategori) {
        $query->where('kategori', $request->kategori);
    }

    if ($request->arama) {
        $query->where('ad', 'like', '%' . $request->arama . '%');
    }

    $menus = $query->get();

    return view('musteri', compact('menus'));
}

    public function show($id)
{
    $menu = Menu::findOrFail($id);

    return view('urun-detay', compact('menu'));
}
}