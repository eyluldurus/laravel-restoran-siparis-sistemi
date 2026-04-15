<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/* ANASAYFA */
Route::get('/', function () {
    return view('welcome');
});

/* LOGIN */
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        return redirect()->route('menu.index');
    } else {
        return back()->withErrors(['Hatalı giriş']);
    }
})->name('login.post');

/* LOGOUT */
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

/* AUTH GEREKTİREN SAYFALAR */
Route::middleware('auth')->group(function () {

    /* MENU LISTE */
    Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');

    /* MENU EKLE */
    Route::get('/menu/ekle', [MenuController::class, 'create'])->name('menu.create');
    Route::post('/menu/ekle', [MenuController::class, 'store'])->name('menu.store');

    /* MENU SIL */
    Route::post('/menu/sil/{id}', [MenuController::class, 'delete'])->name('menu.delete');

    /* MENU DUZENLE */
    Route::get('/menu/duzenle/{id}', [MenuController::class, 'edit'])->name('menu.edit');
    Route::post('/menu/guncelle/{id}', [MenuController::class, 'update'])->name('menu.update');

});