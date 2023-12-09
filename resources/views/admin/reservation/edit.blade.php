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
    <form action="{{ route('admin.reservations.update', ['id' => $reservation->id]) }}" method="post">
        @csrf
        @method('patch')
        ムービーID:<input type="text" name="movie_id" value="{{ $reservation->schedule->movie_id }}"><br>
        スケジュールID:<input type="text" name="schedule_id" value="{{ $reservation->schedule_id }}"><br>
        シートID:<input type="text" name="sheet_id" value="{{ $reservation->sheet_id }}"><br>
        予約者名:<input type="text" name="name" value="{{ $reservation->name }}"><br>
        予約者メールアドレス:<input type="text" name="email" value="{{ $reservation->email }}"><br>
        <input type="submit" value="送信">
    </form>
</body>
</html>
