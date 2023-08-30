<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | {{ config('app.name') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/backoffice/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/backoffice/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/backoffice/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="/backoffice/dist/css/auth.css">
    <link rel="shortcut icon" href="/assets/img/logo.svg" type="image/x-icon">

</head>

<body class="hold-transition login-page">
    @yield('content')
    <script src="/backoffice/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/backoffice/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/backoffice/dist/js/adminlte.min.js"></script>

    <script>
        $('.number').on('keyup', function() {
            var inputValue = $(this).val();
            var cleanValue = inputValue.replace(/\D/g, ''); // Hanya angka yang dibiarkan

            if (cleanValue.startsWith('0')) {
                cleanValue = '62' + cleanValue.substring(1); // Ganti 0 dengan 62
            } else if (!cleanValue.startsWith('62')) {
                cleanValue = '62' + cleanValue;
            }

            $(this).val(cleanValue);
        });
    </script>
</body>

</html>
