<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice</title>
</head>
<body>
    <form action="{{ route('movies.index') }}" method="get">
        キーワード:<input type="text" name="keyword"><br>
        <input type="radio" id="all" name="is_showing" checked>
        <label for="all">すべて</label>
        <input type="radio" id="nowOpen" name="is_showing" value="1">
        <label for="nowOpen">上映中</label>
        <input type="radio" id="publicSchedule" name="is_showing" value="0">
        <label for="publicSchedule">上映予定</label><br>
        <input type="submit" value="検索">
    </form>
    <table>
        <thead>
            <th>映画タイトル</th>
            <th>画像URL</th>
            <th>公開年</th>
            <th>上映中かどうか</th>
            <th>概要</th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($movies as $movie)
                <tr>
                    <td>{{ $movie->title }}</td>
                    <td><img src="{{ $movie->image_url }}" width="100" height="100"></td>
                    <td>{{ $movie->published_year }}</td>
                    <td>{{ $movie->is_showing === 0 ? '上映予定' : '上映中' }}</td>
                    <td>{{ $movie->description }}</td>
                    <td><a href="{{ route('movies.detail', ['id' => $movie->id]) }}">詳細</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $movies->links() }}
</body>
</html>