<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Genre</title>
</head>
<body>
    <h1>Daftar Genre</h1>

        @foreach ($genres as $genre)
            <ul>
                <li>{{$genre['name']}}</li>
                <li>{{$genre['description']}}</li>
            </ul>
            
        @endforeach
</body>
</html>