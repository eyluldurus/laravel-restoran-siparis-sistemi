<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Menü Ekle</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .box {
            background: white;
            padding: 30px;
            border-radius: 12px;
            width: 400px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .error-box {
            background: #ffe5e5;
            color: red;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: #ff7e5f;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #ff5e3a;
        }
    </style>
</head>
<body>

<div class="box">
    <h1>Menü Ekle</h1>

    @if ($errors->any())
        <div class="error-box">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('menu.store') }}" enctype="multipart/form-data">
        @csrf

        <input type="text" name="ad" placeholder="Ürün adı" value="{{ old('ad') }}" required>

        <input type="text" name="aciklama" placeholder="Açıklama" value="{{ old('aciklama') }}">

        <input type="number" name="fiyat" placeholder="Fiyat (₺)" value="{{ old('fiyat') }}" required>

        <select name="kategori" required>
            <option value="">Kategori Seç</option>
            <option value="Ana Yemek">Ana Yemek</option>
            <option value="İçecek">İçecek</option>
            <option value="Tatlı">Tatlı</option>
        </select>

        <input type="file" name="resim">

        <button type="submit">Kaydet</button>
    </form>
</div>

</body>
</html>