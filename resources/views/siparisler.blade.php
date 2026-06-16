<!DOCTYPE html>

<html>
<head>
    <title>Siparişler</title>


<style>
    body{
        margin:0;
        font-family:Arial,sans-serif;
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

    .menu-bar{
        background:white;
        padding:15px;
        text-align:center;
        box-shadow:0 2px 5px rgba(0,0,0,.1);
    }

    .menu-bar a{
        margin:0 10px;
        text-decoration:none;
        font-weight:bold;
        color:#2563eb;
    }

    .container{
        max-width:1100px;
        margin:30px auto;
        padding:20px;
    }

    .card{
        background:white;
        border-radius:15px;
        padding:20px;
        margin-bottom:20px;
        box-shadow:0 4px 12px rgba(0,0,0,.1);
    }

    .durum{
        display:inline-block;
        background:#dbeafe;
        color:#1d4ed8;
        padding:6px 12px;
        border-radius:20px;
        font-weight:bold;
    }

    .btn{
        border:none;
        border-radius:8px;
        padding:10px 15px;
        cursor:pointer;
        color:white;
        margin-right:5px;
        margin-top:10px;
    }

    .hazirlaniyor{
        background:#f59e0b;
    }

    .hazir{
        background:#16a34a;
    }

    .teslim{
        background:#2563eb;
    }

    ul{
        padding-left:20px;
    }
</style>


</head>
<body>

<div class="navbar">
    📦 Sipariş Yönetimi
</div>

<div class="menu-bar">
    <a href="/dashboard">🏠 Dashboard</a>
    <a href="/menu">📋 Menü Yönetimi</a>
    <a href="/siparisler">🧾 Siparişler</a>
    <a href="/qrcode">🔳 QR Kodlar</a>
</div>

<div class="container">

@foreach($siparisler as $siparis)

<div class="card">


<h2>Sipariş #{{ $siparis->id }}</h2>

<p>
    <strong>Masa:</strong>
    {{ $siparis->masa ? $siparis->masa->masa_no : $siparis->masa_id }}
</p>

<p>
    <strong>Toplam:</strong>
    {{ $siparis->toplam_tutar }} TL
</p>

<p>
    <strong>Tarih:</strong>
    {{ $siparis->created_at->format('d.m.Y H:i') }}
</p>

<p>

@if($siparis->durum == 'Bekliyor')

<span class="durum" style="background:#fee2e2;color:#b91c1c;">
    {{ $siparis->durum }}
</span>

@elseif($siparis->durum == 'Hazırlanıyor')

<span class="durum" style="background:#fef3c7;color:#b45309;">
    {{ $siparis->durum }}
</span>

@elseif($siparis->durum == 'Hazır')

<span class="durum" style="background:#dcfce7;color:#15803d;">
    {{ $siparis->durum }}
</span>

@else

<span class="durum" style="background:#e5e7eb;color:#374151;">
    {{ $siparis->durum }}
</span>

@endif

</p>

<h3>Sipariş İçeriği</h3>

<ul>
    @foreach($siparis->detaylar as $detay)

    <li>
        {{ $detay->menu->ad ?? 'Ürün Silinmiş' }}
        x {{ $detay->adet }}
    </li>

    @endforeach
</ul>

<form action="/siparisler/durum/{{ $siparis->id }}" method="POST">
    @csrf

    <button class="btn hazirlaniyor"
            type="submit"
            name="durum"
            value="Hazırlanıyor">
        Hazırlanıyor
    </button>

    <button class="btn hazir"
            type="submit"
            name="durum"
            value="Hazır">
        Hazır
    </button>

    <button class="btn teslim"
            type="submit"
            name="durum"
            value="Teslim Edildi">
        Teslim Edildi
    </button>

</form>

<form action="/siparisler/sil/{{ $siparis->id }}" method="POST"
      style="margin-top:10px;">
    @csrf

    <button
        type="submit"
        onclick="return confirm('Bu sipariş silinsin mi?')"
        style="
            background:#dc2626;
            color:white;
            border:none;
            padding:10px 15px;
            border-radius:8px;
            cursor:pointer;
        ">
        🗑 Siparişi Sil
    </button>
</form>

</div>

@endforeach

</div>

</body>
</html>
