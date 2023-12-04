<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice</title>
</head>
<body>
    <a href="{{ route('admin.movies.create') }}">登録</a>
    <table>
        <thead>
            <th>映画タイトル</th>
            <th>画像URL</th>
            <th>公開年</th>
            <th>上映中かどうか</th>
            <th>概要</th>
            <th>登録日時</th>
            <th>更新日時</th>
            <th></th>
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
                    <td>{{ $movie->created_at }}</td>
                    <td>{{ $movie->updated_at }}</td>
                    <td><a href="{{ route('admin.movies.edit', ['id' => $movie->id]) }}">編集</a></td>
                    <td>
                        <form action="{{ route('admin.movies.destroy', ['id' => $movie->id]) }}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" value="削除" onclick='return confirm("本当に削除しますか？")'>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
