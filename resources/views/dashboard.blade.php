<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

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
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:20px;
        }

        .card{
            background:white;
            padding:25px;
            border-radius:15px;
            text-align:center;
            box-shadow:0 4px 12px rgba(0,0,0,.1);
        }

        .number{
            font-size:35px;
            font-weight:bold;
            color:#2563eb;
        }
    </style>
</head>
<body>

<div class="navbar">
    📊 Yönetim Paneli
</div>

<div class="menu-bar">
    <a href="/dashboard">🏠 Dashboard</a>
    <a href="/menu">📋 Menü Yönetimi</a>
    <a href="/siparisler">🧾 Siparişler</a>
    <a href="/qrcode">🔳 QR Kodlar</a>
</div>

<div class="container">

    <div class="card">
        <h3>Toplam Ürün</h3>
        <div class="number">{{ $toplamUrun }}</div>
    </div>

    <div class="card">
        <h3>Toplam Sipariş</h3>
        <div class="number">{{ $toplamSiparis }}</div>
    </div>

    <div class="card">
        <h3>Bekleyen</h3>
        <div class="number">{{ $bekleyen }}</div>
    </div>

    <div class="card">
        <h3>Hazırlanıyor</h3>
        <div class="number">{{ $hazirlaniyor }}</div>
    </div>

    <div class="card">
        <h3>Hazır</h3>
        <div class="number">{{ $hazir }}</div>
    </div>

    <div class="card">
        <h3>Teslim Edildi</h3>
        <div class="number">{{ $teslim }}</div>
    </div>

    <div class="card">
    <h3>Toplam Ciro</h3>
    <div class="number">{{ $toplamCiro }} TL</div>
</div>

<div class="card">

    <h3>En Çok Satılan Ürün</h3>

    @if($enCokSatilan)

        <div style="font-size:22px;font-weight:bold;color:#2563eb;">
            {{ $enCokSatilan->menu->ad ?? 'Bilinmiyor' }}
        </div>

        <p>
            {{ $enCokSatilan->toplam_adet }} adet
        </p>

    @else

        <p>Henüz satış yok</p>

    @endif

</div>

</div>

</body>
</html>