<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CoreUI Bootstrap 4 Admin Template">
    <meta name="author" content="Lukasz Holeczek">
    <meta name="keyword" content="CoreUI Bootstrap 4 Admin Template">
    <!-- <link rel="shortcut icon" href="assets/ico/favicon.png"> -->

    <title>Administration</title>

    <!-- Icons -->
    <link href="/assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="/assets/css/simple-line-icons.css" rel="stylesheet">
    <link href="/assets/css/toastr.min.css" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="/assets/css/style.css" rel="stylesheet">

    @stack('style')
</head>

<body class="app flex-row align-items-center">
<div class="container">
    <div class="row justify-content-center">
       @yield('content')
    </div>
</div>

<!-- Bootstrap and necessary plugins -->
<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/bower_components/tether/dist/js/tether.min.js"></script>
<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/assets/js/jquery.maskedinput.min.js"></script>
<script src="/assets/js/toastr.min.js"></script>
@stack('script')
</body>

</html>