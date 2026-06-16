<!DOCTYPE html>
<html>
<head>
    <title>{{ $menu->ad }}</title>

    <style>
        body{
            font-family:Arial, sans-serif;
            background:#f3f4f6;
            margin:0;
        }

        .container{
            max-width:900px;
            margin:40px auto;
            background:white;
            border-radius:15px;
            overflow:hidden;
            box-shadow:0 4px 12px rgba(0,0,0,0.1);
        }

        .menu-img{
            width:100%;
            height:400px;
            object-fit:cover;
        }

        .content{
            padding:20px;
        }

        .price{
            font-size:28px;
            font-weight:bold;
            color:#2563eb;
        }

        .back{
            display:inline-block;
            margin-top:20px;
            text-decoration:none;
            color:white;
            background:#2563eb;
            padding:10px 15px;
            border-radius:8px;
        }
    </style>
</head>
<body>

<div style="
    background:linear-gradient(to right,#3b82f6,#2563eb);
    color:white;
    padding:20px;
    text-align:center;
    font-size:28px;
    font-weight:bold;">
    🍽️ Ürün Detayı
</div>

@if(session('masa_id'))
<div style="
    text-align:center;
    margin-top:15px;
    font-size:18px;
    font-weight:bold;
    color:#2563eb;">
    Masa {{ session('masa_id') }}
</div>
@endif

<div class="container">

    @if($menu->resim)
        <img src="{{ asset('storage/' . $menu->resim) }}" class="menu-img">
    @endif

    <div class="content">

        <h1>{{ $menu->ad }}</h1>

        <p>{{ $menu->aciklama }}</p>

        <p>Kategori: {{ $menu->kategori }}</p>

        <div class="price">
            {{ $menu->fiyat }} TL
        </div>

        <form action="/sepete-ekle/{{ $menu->id }}" method="POST">
    @csrf

    <button
        type="submit"
        style="
            background:#16a34a;
            color:white;
            border:none;
            padding:12px 20px;
            border-radius:8px;
            cursor:pointer;
            margin-top:15px;
        ">
        🛒 Sepete Ekle
    </button>
</form>

        <a href="/musteri" class="back">
            ← Menüye Dön
        </a>

        <a href="/sepet"
           style="
           display:inline-block;
           margin-top:10px;
           text-decoration:none;
           color:white;
           background:#16a34a;
           padding:10px 15px;
           border-radius:8px;">
           🛒 Sepete Git
        </a>

    </div>

</div>

</body>
</html>