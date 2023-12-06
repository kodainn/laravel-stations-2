<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice</title>
</head>
<body>
    <form action="{{ route('admin.schedules.update', ['id' => $schedule->id]) }}" method="post">
        @csrf
        @method('patch')
        <input type="hidden" name="movie_id" value="{{ $schedule->movie_id }}">
        開始日付<input type="date" name="start_time_date" value="{{ $schedule->start_time->format('Y-m-d') }}"><br>
        開始時間<input type="time" name="start_time_time" value="{{ $schedule->start_time->format('H:i') }}"><br>
        終了日付<input type="date" name="end_time_date" value="{{ $schedule->end_time->format('Y-m-d') }}"><br>
        終了時間<input type="time" name="end_time_time" value="{{ $schedule->end_time->format('H:i') }}"><br>
        <input type="submit" value="更新">
    </form>
</body>
</html>
