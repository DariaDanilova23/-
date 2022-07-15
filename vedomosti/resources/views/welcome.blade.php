<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Отчёт</title>
    <link rel="icon" type="image/x-icon" href="{{ asset("favicon.ico") }}">
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
    <link rel="stylesheet" href="{{ asset("css/w3.css") }}">
    <script src="{{ asset("js/xlsx.mini.min.js") }}"></script>
    <script>
    function download() {
        var elt = document.getElementById('data-table');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "Страница 1" });
        var date = (new Date()).toISOString().substring(0, 10).replace(/-/g, '.')
        return XLSX.writeFile(wb, `Отчёт_за_${date}.xlsx`);
    }
    </script>
</head>
<body>
    <div class="w3-top w3-bar w3-padding-large w3-white w3-card" style="position: sticky;">

        @include('menu', ['current_table' => 'Отчёт'])
        <button
            class="w3-right w3-button w3-round w3-text-white w3-hover-text-white w3-blue w3-hover-light-blue"
            onclick="download()"
        >
            Скачать .xlsx
        </button>
    </div>
    <table id="data-table" class="w3-content w3-section w3-table w3-bordered">
        @if (isset($professorChart))
            <thead>
                <th>ФИО профессора</th>
                <th>Количество студентов</th>
                <th>Средняя успеваемость студентов</th>
            </thead>
            @foreach ($professorChart as $id => $rowsItem)
            <tr>
                <td>{!! $rowsItem['FIO'] !!}</td>
                <td>{!! $rowsItem['amount'] !!}</td>
                <td>{!! $rowsItem['grade'] !!}</td>
            </tr>
            @endforeach
        @elseif (isset($eachBest))
            <thead>
                <th>ФИО профессора</th>
                <th>ФИО студентов</th>
            </thead>
            @foreach ($eachBest as $id => $rowsItem)
            <tr>
                <td>{!! $rowsItem['FIO'] !!}</td>
                <td>{!! $rowsItem['FIO_student'] !!}</td>
            </tr>
            @endforeach
        @elseif (isset($studentChart))
            <thead>
                <th>ФИО студента</th>
                <th>Средняя оценка</th>
            </thead>
            @foreach ($studentChart as $id => $rowsItem)
            <tr>
                <td>{!! $rowsItem['FIO'] !!}</td>
                <td>{!! $rowsItem['grade'] !!}</td>
            </tr>
            @endforeach
        @endif
    </table>
    <div class="w3-small w3-text-grey w3-center w3-margin">
        Powered by the <a href="https://sheetjs.com/opensource">community version of sheetjs</a>
    </div>
</body>
</html>
