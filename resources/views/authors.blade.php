<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Author</title>
</head>
<body>
    <h1>Daftar Author</h1>

    @foreach ($authors as $author)
        <ul>
            <li>{{ $author['name'] }}</li>
            <li>{{ $author['photo'] }}</li>
            <li>{{ $author['bio'] }}</li>
        </ul>
    @endforeach
</body>
</html>