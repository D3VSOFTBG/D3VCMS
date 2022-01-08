<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>D3VCMS - Install</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/dist/css/adminlte.min.css')}}">
</head>

<body class="hold-transition login-page">

    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1"><b>D3VCMS</b> Install</a>
            </div>
            <div class="card-body">
                <p class="text-center">Fill in all the blanks.</p>

                <form action="{{route('install')}}" method="post">
                    <div class="form-group mb-3">
                        <label for="DB_CONNECTION">DB_CONNECTION</label>
                        <select class="form-control" name="DB_CONNECTION" id="DB_CONNECTION">
                            <option value="mysql">MySQL</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="DB_HOST">DB_HOST</label>
                        <input type="text" class="form-control" id="DB_HOST" placeholder="DB_HOST">
                    </div>
                    <div class="form-group mb-3">
                        <label for="DB_PORT">DB_PORT</label>
                        <input type="text" class="form-control" id="DB_PORT" placeholder="DB_PORT">
                    </div>
                    <div class="form-group mb-3">
                        <label for="DB_DATABASE">DB_DATABASE</label>
                        <input type="text" class="form-control" id="DB_DATABASE" placeholder="DB_DATABASE">
                    </div>
                    <div class="form-group mb-3">
                        <label for="DB_USERNAME">DB_USERNAME</label>
                        <input type="text" class="form-control" id="DB_USERNAME" placeholder="DB_USERNAME">
                    </div>
                    <div class="form-group mb-3">
                        <label for="DB_PASSWORD">DB_PASSWORD</label>
                        <input type="text" class="form-control" id="DB_PASSWORD" placeholder="DB_PASSWORD">
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Install</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>

        <!-- jQuery -->
        <script src="{{asset('/plugins/jquery/jquery.min.js')}}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{asset('/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('/dist/js/adminlte.min.js')}}"></script>
</body>

</html>
