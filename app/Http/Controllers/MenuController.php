<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
   public function index(Request $request)
{
    $kategori = $request->kategori;

    if ($kategori) {
        $menus = Menu::where('kategori', $kategori)->get();
    } else {
        $menus = Menu::all();
    }

    return view('menu', compact('menus'));
}

    public function create()
    {
        return view('ekle');
    }

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
            $path = $request->file('resim')->store('images', 'public');
            $data['resim'] = $path;
        }

        Menu::create($data);

        return redirect('/menu');
    }

    public function delete($id)
    {
        Menu::find($id)->delete();
        return redirect('/menu');
    }

    public function edit($id)
    {
        $menu = Menu::find($id);
        return view('duzenle', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ad' => 'required|min:2',
            'aciklama' => 'nullable',
            'fiyat' => 'required|numeric|min:0',
            'resim' => 'nullable|image',
            'kategori' => 'nullable|string'
        ]);

        $menu = Menu::find($id);

        $data = [
            'ad' => $request->ad,
            'aciklama' => $request->aciklama,
            'fiyat' => $request->fiyat,
            'kategori' => $request->kategori
        ];

        if ($request->hasFile('resim')) {
            $path = $request->file('resim')->store('images', 'public');
            $data['resim'] = $path;
        }

        $menu->update($data);

        return redirect('/menu');
    }
}