<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Genres</title>
</head>
<body>
    <div style="max-width: 850px; margin: 30px auto; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
        <h1 align="center">Genre List</h1>

        @foreach ($genres as $item)
            <ul>
                <li>ID: {{ $item['id'] }}</li>
                <li>Name: {{ $item['name'] }}</li>
                <li>Description: {{ $item['description'] }}</li>
            </ul>
            <br><hr><br>
        @endforeach
    </div>
</body>
</html>
