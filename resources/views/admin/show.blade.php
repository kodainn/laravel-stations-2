<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice</title>
</head>
<body>
    <div>
        <h2>{{ $movie->id }}</h2>
        <h2>{{ $movie->title }}</h2>
        <h2><img src="{{ $movie->image_url }}" width="100" height="100"></h2>
        <h2>{{ $movie->published_year }}</h2>
        <h2>{{ $movie->description }}</h2>
        @if ($movie->is_showing)
            <h2>上映中</h2>
        @else
            <h2>上映予定</h2>
        @endif
    </div>
    <div>
        <a href="{{ route('admin.movies.schedules.create', ['id' => $movie->id]) }}">作成</a>
        <table>
            <thead>
                <th>上映時間</th>
                <th>終了時間</th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                @foreach($movie->schedules as $schedule)
                    <tr>
                        <td>{{ $schedule->start_time }}</td>
                        <td>{{ $schedule->end_time }}</td>
                        <td><a href="{{ route('admin.schedules.edit', ['id' => $schedule->id]) }}">更新</a></td>
                        <td>
                            <form action="{{ route('admin.schedules.destroy', ['id' => $schedule->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <input type="submit" value="削除" onclick='return confirm("本当に削除しますか？")'>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
