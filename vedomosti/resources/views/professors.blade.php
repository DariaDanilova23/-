<!DOCTYPE html>
<html lang="ru">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="fields" content="{{ implode(",", $names) }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Профессора</title>
    <link rel="icon" type="image/x-icon" href="{{ asset("favicon.ico") }}">
    <link rel="stylesheet" href="{{ asset("css/professors.css") }}">
    <link rel="stylesheet" href="{{ asset("css/w3.css") }}">
</head>
<body>
    <div class="w3-top w3-bar w3-padding-large w3-white w3-card" style="position: sticky">
        <div style="display: inline-block">
            <button
                id="undo-btn"
                class="w3-button w3-round w3-text-white w3-hover-text-white w3-blue w3-hover-light-blue"
                onclick="undo()"
            >
                ⮎ Undo
            </button>
            <button
                id="redo-btn"
                class="w3-button w3-round w3-text-white w3-hover-text-white w3-blue w3-hover-light-blue"
                onclick="redo()"
            >
                Redo ⮌
            </button>
        </div>
        <div class="w3-right" style="display: inline-block">
            <button
                id="deselect-btn"
                class="w3-button w3-round w3-text-white w3-hover-text-white w3-grey"
                onclick="deselect()"
            >
                Снять выделение
            </button>
            <button
                id="remove-btn"
                class="w3-button w3-round w3-text-white w3-hover-text-white w3-red w3-hover-light-red"
                onclick="remove()"
            >
                Удалить
            </button>
            <button
                id="save-btn"
                class="w3-button w3-round w3-text-white w3-hover-text-white w3-green w3-hover-light-green"
                onclick="save()"
            >
                Сохранить
            </button>
        </div>
    </div>
    <div id="content" class="w3-content">
        <div id="new-entry" class="w3-panel w3-card w3-padding-16 w3-display-container">
            <table class="w3-table">
                <tr><td>ФИО</td><td><input class="w3-input" type="text" name="FIO" value=""/></td></tr>
                <tr><td>Адрес</td><td><input class="w3-input" type="text" name="Address" value=""/></td></tr>
                <tr><td>Телефон</td><td><input class="w3-input" type="text" name="PhoneNo" value=""/></td></tr>
                <tr><td>Оплата</td><td><input class="w3-input" type="number" name="Salary" value=""/></td></tr>
            </table>
            <button
                id="add-btn"
                class="w3-right w3-button w3-round w3-text-white w3-hover-text-white w3-green w3-hover-light-green"
                style="margin-top: 8px; margin-right: 8px"
                onclick="add()"
            >
                Добавить
            </button>
        </div>
        {{-- TODO: deduplicate --}}
        <template id="entry-template">
            <div class="entry w3-panel w3-card w3-padding-16 w3-display-container">
                <input class="entry-checkbox w3-check w3-display-topright" type="checkbox">
                <table class="w3-table">
                    <tr><td>ID</td><td><input class="entry-id w3-input" type="number" name="id" value="" disabled/></td></tr>
                    <tr><td>ФИО</td><td><input class="entry-field w3-input" type="text" name="FIO" value=""/></td></tr>
                    <tr><td>Адрес</td><td><input class="entry-field w3-input" type="text" name="Address" value=""/></td></tr>
                    <tr><td>Телефон</td><td><input class="entry-field w3-input" type="text" name="PhoneNo"value=""/></td></tr>
                    <tr><td>Оплата</td><td><input class="entry-field w3-input" type="number" name="Salary"value=""/></td></tr>
                </table>
            </div>
        </template>
        @foreach ($rows as $rowsItem)
        <div class="entry w3-panel w3-card w3-padding-16 w3-display-container">
            <input class="entry-checkbox w3-check w3-display-topright" type="checkbox">
            <table class="w3-table">
                <tr><td>ID</td><td><input class="entry-id w3-input" type="number" name="id" value="{!! $rowsItem['id'] !!}" disabled/></td></tr>
                <tr><td>ФИО</td><td><input class="entry-field w3-input" type="text" name="FIO" value="{!! $rowsItem['FIO'] !!}"/></td></tr>
                <tr><td>Адрес</td><td><input class="entry-field w3-input" type="text" name="Address" value="{!! $rowsItem['Address'] !!}"/></td></tr>
                <tr><td>Телефон</td><td><input class="entry-field w3-input" type="text" name="PhoneNo"value="{!! $rowsItem['PhoneNo'] !!}"/></td></tr>
                <tr><td>Оплата</td><td><input class="entry-field w3-input" type="number" name="Salary"value="{!! $rowsItem['Salary'] !!}"/></td></tr>
            </table>
        </div>
        @endforeach
    </div>
    <script src="{{ asset("js/professors.js") }}"></script>
</body>
</html>