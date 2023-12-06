<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice</title>
</head>
<body>
    <form action="{{ route('admin.movies.scheduleStore', ['id' => $id]) }}" method="post">
        @csrf
        <input type="hidden" value="{{ $id }}">
        開始日付<input type="date" name="start_time_date"><br>
        開始時間<input type="time" name="start_time_time"><br>
        終了日付<input type="date" name="end_time_date"><br>
        終了時間<input type="time" name="end_time_time"><br>
        <input type="submit" value="送信">
    </form>
</body>
</html>
