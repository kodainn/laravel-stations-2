<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice</title>
</head>
<body>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    <form action="{{ route('reservations.store') }}" method="post">
        @csrf
        <input type="hidden" name="movie_id" value="{{ $movie_id }}">
        <input type="hidden" name="schedule_id" value="{{ $schedule_id }}">
        <input type="hidden" name="sheet_id" value="{{ $sheet_id }}">
        予約者名:<input type="text" name="name" value=""><br>
        予約者メールアドレス:<input type="text" name="email" value=""><br>
        <input type="hidden" name="date" value="{{ $date }}">
        <input type="submit" value="送信">
    </form>
</body>
</html>
