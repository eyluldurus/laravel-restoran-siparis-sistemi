<!DOCTYPE html>

<html>
<head>
    <title>Sepetim</title>


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

    .container{
        max-width:900px;
        margin:30px auto;
        padding:20px;
    }

    .card{
        background:white;
        padding:20px;
        border-radius:15px;
        margin-bottom:15px;
        box-shadow:0 4px 12px rgba(0,0,0,0.1);
    }

    .toplam{
        background:white;
        padding:20px;
        border-radius:15px;
        margin-top:20px;
        box-shadow:0 4px 12px rgba(0,0,0,0.1);
        text-align:center;
    }

    .btn{
        border:none;
        padding:10px 18px;
        border-radius:8px;
        cursor:pointer;
    }

    .btn-danger{
        background:#dc2626;
        color:white;
    }

    .btn-success{
        background:#16a34a;
        color:white;
        padding:12px 24px;
        font-size:16px;
    }

    .menu-link{
        display:inline-block;
        margin-top:20px;
        text-decoration:none;
        color:#2563eb;
        font-weight:bold;
    }

    .empty{
        background:white;
        padding:30px;
        border-radius:15px;
        text-align:center;
        box-shadow:0 4px 12px rgba(0,0,0,0.1);
    }
</style>

</head>
<body>

<div class="navbar">
    🛒 Sepetim
</div>

<div class="container">

@if(session('basarili'))
<div style="
    background:#dcfce7;
    color:#166534;
    padding:15px;
    border-radius:10px;
    margin-bottom:20px;
    text-align:center;
    font-weight:bold;
">
    {{ session('basarili') }}
</div>
@endif

@if($sepetler->count() == 0)

<div class="empty">
    <h2>Sepet boş</h2>
</div>

@else

@foreach($sepetler as $sepet)

<div class="card">

    <h3>{{ $sepet->menu->ad }}</h3>

    <p>Adet: {{ $sepet->adet }}</p>

    <p>Birim Fiyat: {{ $sepet->fiyat }} TL</p>

    <p>
        Tutar:
        {{ $sepet->adet * $sepet->fiyat }} TL
    </p>

    <form action="/sepet/sil/{{ $sepet->id }}" method="POST">
        @csrf

        <button type="submit" class="btn btn-danger">
            Sil
        </button>
    </form>

</div>

@endforeach

<div class="toplam">

    <h2>Toplam Tutar: {{ $toplam }} TL</h2>

    <form action="/siparis-ver" method="POST">
        @csrf

        <button type="submit" class="btn btn-success">
            Sipariş Ver
        </button>
    </form>

</div>

@endif

<a href="/musteri" class="menu-link">
    ← Menüye Dön
</a>

</div>

</body>
</html>
