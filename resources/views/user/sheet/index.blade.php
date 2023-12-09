<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice</title>
</head>
<body>
    <table>
        <thead>
            <th>.</th>
            <th>.</th>
            <th>スクリーン</th>
            <th>.</th>
            <th>.</th>
        </thead>
        <tbody>
            @if(session('fail'))
                {{ session('fail') }}
            @endif
            @foreach($sheetList as $sheetRow)
                <tr>
                    @foreach($sheetRow as $sheetCol)
                        <td>
                            <a href="{{ route('movies.reservations.create', [
                                'movie_id' => $movie_id,
                                'schedule_id' => $schedule_id
                            ]) . '?date=' . $date .'&sheetId='. $sheetCol['id'] }}">
                                {{ $sheetCol['name'] }}
                            </a>
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>