<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Selamat Datang</title>
</head>
<body>
    <h1>Hello World</h1>
    <p>Selamat Datang Di Toko Book Sales</p>

     @foreach ($books as $book)
        <ul>
            <li>{{ $book['title'] }}</li>
            <li>{{ $book['description'] }}</li>
            <li>Rp {{ number_format($book['price'], 0, ',', '.') }}</li>
            <li>Stok: {{ $book['stok'] }}</li>
        </ul>
    @endforeach
</body>
</html>