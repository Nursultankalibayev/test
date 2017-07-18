<!DOCTYPE html>
<html lang="ru">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Admin Panel">
    <meta name="author" content="Nursultan Kalibayev">
    <link rel="shortcut icon" href="/assets/img/favicon.png">

    <title>Администрация</title>

    <!-- Icons -->
    <link href="/assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="/assets/css/simple-line-icons.css" rel="stylesheet">
    <link href="/assets/css/toastr.min.css" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="/assets/css/style.css" rel="stylesheet">
    @stack('style')
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
<header class="app-header navbar">
    <button class="navbar-toggler mobile-sidebar-toggler d-lg-none" type="button">☰</button>
    <a class="navbar-brand" href="#"></a>
    <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item px-3">
            <a class="nav-link" href="javascript:void(0);">Пользователь : <b>{{\Auth::user()['name']}}</b></a>
        </li>
        @if(\Illuminate\Support\Facades\Auth::user()['role_id'] == 1)
            <li class="nav-item px-3">
                <a class="nav-link" href="/admin">Администрация</a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link" href="/admin/user">Пользователи</a>
            </li>
        @else
            <li class="nav-item px-3">
                <a class="nav-link" href="/developer/task">Задачи</a>
            </li>
        @endif

        <li class="nav-item px-3">
            <a class="nav-link" href="/logout">Выход</a>
        </li>
    </ul>
</header>

<div class="app-body">
    @include('admin.layouts.sidebar')
    <!-- Main content -->
    <main class="main">

        <!-- Breadcrumb -->
       @yield('breadcrumb')
        <div class="container-fluid">
            @yield('content')

        </div>
        <!-- /.conainer-fluid -->
    </main>
</div>

<footer class="app-footer">
    <a href="#">Nursultan Kalibayev</a> © 2017
    <span class="float-right">Powered by <a href="#">Nursultan</a>

    </span>

</footer>

<!-- Bootstrap and necessary plugins -->
<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/bower_components/tether/dist/js/tether.min.js"></script>
<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/bower_components/pace/pace.min.js"></script>
<script src="/assets/js/app.js"></script>
<script src="/assets/js/toastr.min.js"></script>
<script src="/tinymce/tinymce.min.js"></script>
@stack('script')
</body>

</html>