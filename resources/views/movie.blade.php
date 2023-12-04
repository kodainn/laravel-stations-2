<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice</title>
</head>
<body>
    <ul>
    @foreach ($movies as $movie)
        <div>
            <p>タイトル: {{ $movie->title }}</p>
            <p>画像: <img src="{{ $movie->image_url }}"></p>
            <p>作成日時: {{ $movie->created_at }}</p>
            <p>更新日時: {{ $movie->updated_at }}</p>
        </div>
    @endforeach
    </ul>
</body>
</html>