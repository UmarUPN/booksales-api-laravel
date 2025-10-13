<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Books</title>
</head>
<body>
    <div style="max-width: 850px; margin: 30px auto; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
        <h1 align="center">Book List</h1>

        @foreach ($bookList as $item)
            <ul>
                <li>ID: {{ $item['id'] }}</li>
                <li>Title: {{ $item['title'] }}</li>
                <li>Description: {{ $item['description'] }}</li>
                <li>Price: {{ $item['price'] }}</li>
                <li>Stock: {{ $item['stock'] }}</li>
                <li>Cover Photo: {{ $item['cover_photo'] }}</li>
                <li>Genre ID: {{ $item['genre_id'] }}</li>
                <li>Author ID: {{ $item['author_id'] }}</li>
            </ul>
            <br><hr><br>
        @endforeach
    </div>
</body>
</html>
