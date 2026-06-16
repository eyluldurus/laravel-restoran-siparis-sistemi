<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    // Menü listeleme + filtre
    public function index(Request $request)
    {
        $menus = $request->kategori
            ? Menu::where('kategori', $request->kategori)->get()
            : Menu::all();

        return view('menu', compact('menus'));
    }

    // Menü ekleme sayfası
    public function create()
    {
        return view('ekle');
    }

    // Menü ekleme işlemi
    public function store(Request $request)
    {
        $request->validate([
            'ad' => 'required|min:2',
            'aciklama' => 'nullable',
            'fiyat' => 'required|numeric|min:0',
            'resim' => 'nullable|image',
            'kategori' => 'nullable|string'
        ]);

        $data = $request->all();

        if ($request->hasFile('resim')) {
            $data['resim'] = $request->file('resim')->store('images', 'public');
        }

        Menu::create($data);

        return redirect()->route('menu.index');
    }

    // Menü silme
    public function delete($id)
    {
        Menu::findOrFail($id)->delete();
        return redirect()->route('menu.index');
    }

    // Menü düzenleme sayfası
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('duzenle', compact('menu'));
    }

    // Menü güncelleme
    public function update(Request $request, $id)
    {
        $request->validate([
            'ad' => 'required|min:2',
            'aciklama' => 'nullable',
            'fiyat' => 'required|numeric|min:0',
            'resim' => 'nullable|image',
            'kategori' => 'nullable|string'
        ]);

        $menu = Menu::findOrFail($id);

        $data = [
            'ad' => $request->ad,
            'aciklama' => $request->aciklama,
            'fiyat' => $request->fiyat,
            'kategori' => $request->kategori
        ];

        if ($request->hasFile('resim')) {
            $data['resim'] = $request->file('resim')->store('images', 'public');
        }

        $menu->update($data);

        return redirect()->route('menu.index');
    }
}