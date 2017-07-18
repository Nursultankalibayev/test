<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                Модули
            </li>
            @if(\Illuminate\Support\Facades\Auth::user()['role_id'] == 1)
            <li class="nav-item nav-dropdown">
                <a class="nav-link" href="/admin/user"><i class="icon-puzzle"></i>Пользователи</a>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link" href="/admin/status"><i class="icon-puzzle"></i>Статусы задач</a>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link" href="/admin/type"><i class="icon-puzzle"></i>Типы задач</a>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link" href="/admin/task"><i class="icon-puzzle"></i>Задачи</a>
            </li>
            @else
                <li class="nav-item nav-dropdown">
                    <a class="nav-link" href="/developer/task"><i class="icon-puzzle"></i>Задачи</a>
                </li>
            @endif
        </ul>
    </nav>
</div>
