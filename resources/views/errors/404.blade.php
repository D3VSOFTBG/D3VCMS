<!DOCTYPE html>
<html lang="en" class="w-100 h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <meta name="robots" content="noindex">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/dist/css/adminlte.min.css')}}">
</head>

<body class="bg-dark w-100 h-100">
    <table class="w-100 h-100">
        <tr>
            <td>
                <!-- Main content -->
                <section class="content text-center">
                    <h1 class="text-warning" style="font-size: 100px;"> 404</h1>
                    <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>

                    <p class="text-center">We could not find the page you were looking for. Meanwhile, you may
                        @if (str_contains(Request::url(), 'admin'))
                        <a href="{{route('admin')}}">return to dashboard</a>.
                        @else
                        <a href="{{route('home')}}">return to home</a>.
                        @endif
                        </p>
                </section>
                <!-- /.content -->
            </td>
        </tr>
    </table>
</body>

</html>
