<!DOCTYPE html>

<html>
<head>
    <title>QR Kod Yönetimi</title>


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
        max-width:1200px;
        margin:30px auto;
        display:grid;
        grid-template-columns:repeat(auto-fill,minmax(250px,1fr));
        gap:20px;
        padding:20px;
    }

    .card{
        background:white;
        padding:20px;
        border-radius:15px;
        text-align:center;
        box-shadow:0 4px 12px rgba(0,0,0,.1);
    }

    .masa{
        font-size:22px;
        font-weight:bold;
        margin-bottom:15px;
    }

    .link{
        margin-top:15px;
        font-size:12px;
        color:gray;
        word-break:break-all;
    }
</style>


</head>
<body>

<div class="navbar">
    🔳 QR Kod Yönetimi
</div>

<div class="menu-bar">
    <a href="/dashboard">🏠 Dashboard</a>
    <a href="/menu">📋 Menü Yönetimi</a>
    <a href="/siparisler">🧾 Siparişler</a>
    <a href="/qrcode">🔳 QR Kodlar</a>
</div>

<div style="text-align:center;margin-top:20px;">
    <button
        onclick="window.print()"
        style="
            background:#16a34a;
            color:white;
            border:none;
            padding:12px 20px;
            border-radius:8px;
            cursor:pointer;
            font-weight:bold;
        ">
        🖨️ QR Kodları Yazdır
    </button>
</div>

<div class="container">

@for($i = 1; $i <= 5; $i++)

<div class="card">


<div class="masa">
    Masa {{ $i }}
</div>

{!! QrCode::size(180)->generate('http://172.20.10.11:8000/musteri?masa=' . $i) !!}

<div class="link">
    Masa {{ $i }} QR Kodu
</div>


</div>

@endfor

</div>

</body>
</html>
