<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Genre</title>
</head>
<body>
    <h1>Daftar Genre</h1>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($genres as $genre)
            <tr>
                <td>{{ $genre['id'] }}</td>
                <td>{{ $genre['name'] }}</td>
                <td>{{ $genre['description'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>