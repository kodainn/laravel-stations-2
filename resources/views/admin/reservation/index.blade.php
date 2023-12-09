<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice</title>
</head>
<body>
    <a href="{{ route('admin.reservations.create') }}">追加</a>
    <table>
        <thead>
            <th>日付</th>
            <th>名前</th>
            <th>メールアドレス</th>
            <th>座席</th>
            <th></th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->date }}</td>
                    <td>{{ $reservation->name }}</td>
                    <td>{{ $reservation->email }}</td>
                    <td>{{strtoupper($reservation->sheet->row)}}{{$reservation->sheet->column}}</td>
                    <td><a href="{{ route('admin.reservations.edit', ['id' => $reservation->id]) }}">編集</a></td>
                    <td>
                        <form action="{{ route('admin.reservations.destroy', ['id' => $reservation->id]) }}" method="post"
                            onsubmit="return confirm('本当に削除しますか?')"    
                        >
                            @csrf
                            @method('delete')
                            <button>削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
