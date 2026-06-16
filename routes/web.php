<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MusteriController;
use App\Http\Controllers\SepetController;
use App\Http\Controllers\SiparisController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/musteri', [MusteriController::class, 'index'])->name('musteri.index');
Route::get('/musteri/urun/{id}', [MusteriController::class, 'show'])->name('musteri.show');
Route::get('/sepet', [SepetController::class, 'index'])->name('sepet.index');
Route::post('/sepete-ekle/{id}', [SepetController::class, 'ekle'])->name('sepet.ekle');
Route::post('/sepet/sil/{id}', [SepetController::class, 'sil'])->name('sepet.sil');
Route::post('/siparis-ver', [SepetController::class, 'siparisVer'])->name('siparis.ver');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

   if (Auth::attempt($credentials)) {
    return redirect()->route('dashboard');
}

    return back()->withErrors(['Hatalı giriş']);
})->name('login.post');


Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [SiparisController::class, 'dashboard'])->name('dashboard');
    Route::get('/siparisler', [SiparisController::class, 'index'])->name('siparisler.index');
    Route::post('/siparisler/durum/{id}', [SiparisController::class, 'durumGuncelle'])->name('siparis.durum');
    Route::post('/siparisler/sil/{id}', [SiparisController::class, 'sil'])->name('siparis.sil');
    
    // Menü listeleme
    Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');

    // Menü ekleme
    Route::get('/menu/ekle', [MenuController::class, 'create'])->name('menu.create');
    Route::post('/menu/ekle', [MenuController::class, 'store'])->name('menu.store');

    // Menü düzenleme
    Route::get('/menu/duzenle/{id}', [MenuController::class, 'edit'])->name('menu.edit');
    Route::post('/menu/guncelle/{id}', [MenuController::class, 'update'])->name('menu.update');

    // Menü silme
    Route::post('/menu/sil/{id}', [MenuController::class, 'delete'])->name('menu.delete');
});

Route::get('/qrcode', function () {
    return view('qrcode');
});