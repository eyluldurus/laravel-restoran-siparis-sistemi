<!DOCTYPE html>
<html>
<head>
    <title>Menü</title>

    <style>
        body {
            font-family: Arial;
            margin: 0;
            background: #f3f4f6;
        }

        /* NAVBAR */
        .navbar {
            background: linear-gradient(to right, #3b82f6, #2563eb);
            color: white;
            padding: 15px;
            font-size: 20px;
            font-weight: bold;
        }

        /* KATEGORİ */
        .categories {
            text-align: center;
            margin: 20px;
        }

        .categories button {
            margin: 5px;
            padding: 8px 15px;
            border: none;
            border-radius: 20px;
            background: #e5e7eb;
            cursor: pointer;
        }

        .categories button.active {
            background: #3b82f6;
            color: white;
        }

        /* 🔥 GRID DÜZELTİLDİ */
        .container {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* SABİT 3 KOLON */
            gap: 20px;
            padding: 20px;
        }

        /* CARD */
        .card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        /* 🔥 RESİM DÜZELTİLDİ */
        .menu-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .card h3 {
            margin: 0;
        }

        .price {
            margin-top: 10px;
            font-weight: bold;
        }

        /* BUTON */
        .btn {
            margin-top: 10px;
            padding: 6px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .delete {
            background: red;
            color: white;
        }

        .edit {
            background: orange;
            color: white;
            text-decoration: none;
            padding: 6px 10px;
            display: inline-block;
        }

        .add {
            display: block;
            text-align: center;
            margin: 15px;
            text-decoration: none;
            font-weight: bold;
        }
    </style>

</head>
<body>

<form method="POST" action="/logout" style="text-align:right; margin:10px;">
    @csrf
    <button type="submit">Çıkış Yap</button>
</form>

<div class="navbar">
    🍽️ Restoran Menü
</div>

<a href="/menu/ekle" class="add">+ Yeni Menü Ekle</a>

<div class="categories">
    <a href="/menu"><button>Tümü</button></a>
    <a href="/menu?kategori=Ana Yemek"><button>Ana Yemek</button></a>
    <a href="/menu?kategori=İçecek"><button>İçecek</button></a>
    <a href="/menu?kategori=Tatlı"><button>Tatlı</button></a>
</div>

<div class="container">

@foreach($menus as $menu)
    <div class="card">

        @if($menu->resim)
            <img src="{{ asset('storage/' . $menu->resim) }}" class="menu-img">
        @endif

        <h3>{{ $menu->ad }}</h3>
        <p>{{ $menu->aciklama }}</p>
        
        @if($menu->kategori)
            <p style="font-size:12px; color:gray;">
                Kategori: {{ $menu->kategori }}
            </p>
        @endif

        <div class="price">{{ $menu->fiyat }} TL</div>

        <form action="/menu/sil/{{ $menu->id }}" method="POST">
            @csrf
            <button class="btn delete" onclick="return confirm('Silinsin mi?')">Sil</button>
        </form>

        <a href="/menu/duzenle/{{ $menu->id }}" class="edit">Düzenle</a>
    </div>
@endforeach

</div>

</body>
</html>