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
            タイトル: {{ $movie->title }}
            <img src="{{ $movie->image_url }}">
            登録日時: {{ $movie->created_at }}
            更新日時: {{ $movie->updated_at }}
        </div>
    @endforeach
    </ul>
</body>
</html>