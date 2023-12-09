<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice</title>
</head>
<body>
    @if(session('succ'))
        {{ session('succ') }}
    @endif
    <div>
        <p>{{ $movie->title }}</p>
        <p>{{ $movie->image_url }}</p>
        <p>{{ $movie->published_year }}</p>
        <p>{{ $movie->description }}</p>
    </div>
    @foreach($schedules as $schedule)
        <div>
            {{ $schedule->start_time->format('H:i') }}
            ～
            {{ $schedule->end_time->format('H:i') }}
            <a href="{{ route('movies.sheets.index', [
                'movie_id' => $movie->id,
                'schedule_id' => $schedule->id
            ]) . '?date=' . $schedule->start_time->format('Y-m-d') }}">座席を予約する</a>
        </div>
    @endforeach
</body>
</html>