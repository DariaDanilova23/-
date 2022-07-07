<!DOCTYPE html>
<html lang="ru">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <title>Профессора</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

</head>
<table id="data-table" class="w3-content w3-section w3-table w3-bordered">
    <thead>
    @foreach ($tittle as $tittleItem)
    <th>{!! $tittleItem !!}</th>
    @endforeach
    </thead>
    @foreach ($rows as $rowsItem)
        <tr>
            @foreach ($names as $nameItem)
                @if(is_array($rowsItem[$nameItem]))
                    <td>["{{implode("\"], [\"",$rowsItem[$nameItem])}}"]</td>
                @else <td> {!! $rowsItem[$nameItem]!!}</td>
                @endif
            @endforeach
            <input hidden class="link" value="{{$linkURL}}">
            <td><button class="delete-item" id="{{$rowsItem['id']}}">x</button></td>
            <td><form class="updateForm" >
                        @csrf
                    @foreach ($names as $nameItem)
                        <input id="{{$nameItem}}" name="{{$nameItem}}"/>
                    @endforeach
                        <button  id="{{$rowsItem['id']}}" class="updateButton">Обновить</button>
                    </form>
            </td>
        </tr>
    @endforeach
</table>
    <form method="put" enctype="multipart/form-data" action={{route("{$linkURL}".".create")}}>
        @csrf
        @foreach ($names as $nameItem)
            <input id="{{$nameItem}}" name="{{$nameItem}}"/>
        @endforeach
        <button>Добавить</button>
    </form>
</body>
<script src={{asset('js/remove.js') }}></script>
<script>$(document).ready(function() {
        $(".updateButton").click(function(e) {
            let i= new Array();
            @foreach ($names as $nameItem)
                i["{{$nameItem}}"] =$(this).closest('.updateForm').find("#{{$nameItem}}").val();
            @endforeach
            let button= $(".updateButton").attr('id');
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post('update-'+"{{$linkURL}}", {
                id:button,
                @foreach ($names as $nameItem)
                "{{$nameItem}}":i["{{$nameItem}}"],
                @endforeach
            }).done(function(data) {
                document.location.reload();
            })
        });
    });
</script>
</html>

