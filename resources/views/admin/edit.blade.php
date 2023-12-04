<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice</title>
</head>
<body>
    @if (session('flash_message'))
        <div class="flash_message">
            {{ session('flash_message') }}
        </div>
    @endif
    <form action="{{ route('admin.movies.update', ['id' => $movie->id]) }}" method="post">
        @csrf
        @method('patch')
        タイトル:<input type="text" name="title" value="{{ $movie->title }}"><br>
        画像URL:<input type="text" name="image_url" value="{{ $movie->image_url }}"><br>
        公開年:<input type="text" name="published_year" value="{{ $movie->published_year }}"><br>
        上映状況:<input type="checkbox" name="is_showing" value="1" {{ $movie->is_showing ? 'checked' : '' }} ><br>
        概要:<textarea name="description"></textarea>
        <input type="submit" value="送信">
    </form>
</body>
</html>
