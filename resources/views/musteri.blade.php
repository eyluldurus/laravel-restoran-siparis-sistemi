<!DOCTYPE html>
<html>
<head>
    <title>Müşteri Menüsü</title>

    <style>
        body{
            margin:0;
            font-family:Arial, sans-serif;
            background:#f3f4f6;
        }

        .navbar{
            background:linear-gradient(to right,#3b82f6,#2563eb);
            color:white;
            padding:20px;
            text-align:center;
            font-size:28px;
            font-weight:bold;
        }

        .categories{
            text-align:center;
            margin:20px;
        }

        .categories a{
            text-decoration:none;
        }

        .categories button{
            margin:5px;
            padding:10px 18px;
            border:none;
            border-radius:20px;
            background:#e5e7eb;
            cursor:pointer;
        }

        .container{
            display:flex;
            flex-wrap:wrap;
            gap:20px;
            padding:20px;
            justify-content:center;
        }

        .card{
            width:300px;
            background:white;
            border-radius:15px;
            overflow:hidden;
            box-shadow:0 4px 12px rgba(0,0,0,0.1);
            transition:0.3s;
        }

        .card:hover{
            transform:translateY(-5px);
        }

        .menu-img{
            width:100%;
            height:220px;
            object-fit:cover;
        }

        .card-content{
            padding:15px;
        }

        .card h3{
            margin:0;
        }

        .card p{
            height:60px;
            overflow:hidden;
        }

        .kategori{
            color:gray;
            font-size:13px;
            margin-top:8px;
        }

        .price{
            margin-top:12px;
            font-size:22px;
            font-weight:bold;
            color:#2563eb;
        }
    </style>
</head>
<body>

<div class="navbar">
    🍽️ Restoran Menüsü
</div>

@if(session('masa_id'))
<div style="
    text-align:center;
    margin-top:10px;
    font-size:18px;
    font-weight:bold;
    color:#2563eb;">
    Masa {{ session('masa_id') }}
</div>
@endif

<div style="text-align:center; margin-top:15px;">
    <a href="/sepet"
       style="
       background:#16a34a;
       color:white;
       padding:10px 20px;
       border-radius:8px;
       text-decoration:none;
       font-weight:bold;">
       🛒 Sepetim
    </a>
</div>

<form action="/musteri" method="GET" style="text-align:center; margin-top:20px;">
    <input
        type="text"
        name="arama"
        placeholder="Ürün ara..."
        value="{{ request('arama') }}"
        style="padding:10px; width:250px; border-radius:8px; border:1px solid #ccc;">

    <button
        type="submit"
        style="padding:10px 15px; border:none; border-radius:8px; background:#2563eb; color:white;">
        Ara
    </button>
</form>

<div class="categories">
    <a href="/musteri"><button>Tümü</button></a>
    <a href="/musteri?kategori=Ana Yemek"><button>Ana Yemek</button></a>
    <a href="/musteri?kategori=İçecek"><button>İçecek</button></a>
    <a href="/musteri?kategori=Tatlı"><button>Tatlı</button></a>
</div>

<div class="container">

@foreach($menus as $menu)

<a href="/musteri/urun/{{ $menu->id }}" style="text-decoration:none; color:inherit;">
<div class="card">

    @if($menu->resim)
        <img src="{{ asset('storage/' . $menu->resim) }}" class="menu-img">
    @endif

    <div class="card-content">

        <h3>{{ $menu->ad }}</h3>

        <p>{{ $menu->aciklama }}</p>

        <div class="kategori">
            Kategori: {{ $menu->kategori }}
        </div>

        <div class="price">
            {{ $menu->fiyat }} TL
        </div>

    </div>

</div>
</a>

@endforeach

</div>

</body>
</html>