<!DOCTYPE html>
<html lang="ru">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <title>Профессора</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

</head>
<body>
    <table>
        <thead>
            <th>ID</th>
            <th>ФИО профессора</th>
            <th>Адрес</th>
            <th>Телефон</th>
            <th>Оплата</th>
        </thead>
        <tr>
            <td>0</td>
            <td>Ковалевский Александр Александрович</td>
            <td>Севастополь, ул. Университетская, 33, ауд. Г-603</td>
            <td>+7 8692 41-77-41 доб. 1019</td>
            <td>300 к/наносек.</td>
        </tr>
    </table>

    <button class="delete-item" id="3">Удалить</button><!--Заменить id="id_professor"-->

    <form class="updateForm"> <!--Заменить id="id_professor"-->
        @csrf
        <input id="FIO" name="FIO"/>
        <input id="Address" name="Address"/>
        <input id="PhoneNo" name="PhoneNo"/>
        <input id="Salary" name="Salary"/>
        <button id="1" class="updateButton">Обновить</button>
    </form>
    <form method="POST" action={{route("add.recordProfessor")}}>
        @csrf
        <input id="FIO" name="FIO"/>
        <input id="Address" name="Address"/>
        <input id="PhoneNo" name="PhoneNo"/>
        <input id="Salary" name="Salary"/>
        <button>Добавить</button>
    </form>
</body>
<script src={{asset('js/remove.js') }}></script>
<script>$(document).ready(function() {
        $(".updateButton").click(function(e) {
            let id1= $(".updateButton").attr('id');
            let FIO1 = $(this).closest('.updateForm').find('#FIO').val();
            let Address1 = $(this).closest('.updateForm').find('#Address').val();
            let PhoneNo1 = $(this).closest('.updateForm').find('#PhoneNo').val();
            let Salary1 = $(this).closest('.updateForm').find('#Salary').val();
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post('update-professor', {
                id:id1,
                FIO:FIO1,
                Address:Address1,
                PhoneNo:PhoneNo1,
                Salary:Salary1,
            }).done(function(data) {
                console.log(data);
            })
        });
    });

</script>
</html>

