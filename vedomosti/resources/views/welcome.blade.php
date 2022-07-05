<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Отчёт</title>
        <link rel="stylesheet" href="{{ asset("css/style.css")}}">
    </head>
    <body class="antialiased">
    <header>
    </header>
    <a href={{route('report')}}>x</a>
    <table>
        <thead>
        <th>ФИО профессора</th>
        <th>Количество студентов</th>
        <th>Средняя успеваемость студентов</th>
        </thead>
        @foreach ($rows as $rowsItem)
        <tr>
            <td> {!! $rowsItem['FIO']!!}</td>
            <td>{!! $rowsItem['Amount']!!}</td>
            <td>{!! $rowsItem['Average_grade']!!}</td>
        </tr>
        @endforeach
    </table>
    </body>
</html>
