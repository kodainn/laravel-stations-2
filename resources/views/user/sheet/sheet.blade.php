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
            @foreach($sheetList as $sheetRow)
                <tr>
                    @foreach($sheetRow as $sheetCol)
                        <td>
                            {{ $sheetCol['name'] }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>