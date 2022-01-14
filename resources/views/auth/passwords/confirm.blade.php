@section('page_name'){{ 'Confirm Password' }}@endsection

@include('auth.inc.header')

<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="{{route('home')}}" class="h1">{{setting('TITLE')}}</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">@yield('page_name')</p>

            <form class="mb-3" action="{{route('password.confirm')}}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Confirm</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">Forgot Password?</a>
            @endif
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->

@include('auth.inc.footer')
