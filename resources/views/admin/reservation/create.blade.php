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
    <form action="{{ route('admin.reservations.store') }}" method="post">
        @csrf
        ムービーID:<input type="text" name="movie_id" value=""><br>
        スケジュールID:<input type="text" name="schedule_id" value=""><br>
        シートID:<input type="text" name="sheet_id" value=""><br>
        予約者名:<input type="text" name="name" value=""><br>
        予約者メールアドレス:<input type="text" name="email" value=""><br>
        <input type="submit" value="送信">
    </form>
</body>
</html>
