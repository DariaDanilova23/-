<div style="display: inline-block; padding-right: 4px; padding-left: 16px;">
    Таблица
</div><div
    class="w3-dropdown-hover" style="float: none">
    <button class="w3-button" style="padding-left: 4px; font-weight: bold">{{ $current_table }}</button>
    <div class="w3-dropdown-content w3-bar-block w3-card-4" style="position: fixed">
        <a class="w3-bar-item w3-button" href="{{ route('professor.index') }}">Профессора</a>
        <a class="w3-bar-item w3-button" href="{{ route('course.index') }}">Курсы</a>
        <a class="w3-bar-item w3-button" href="{{ route('student.index') }}">Студенты</a>
        <a class="w3-bar-item w3-button" href="{{ route('activecourse.index') }}">Запись на курсы</a>
    </div>
</div>
