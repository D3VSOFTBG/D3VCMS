@section('page_name'){{ 'Verify' }}@endsection

@include('auth.inc.header')

<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="{{route('home')}}" class="h1">{{setting('TITLE')}}</a>
        </div>
        <div class="card-body">
            @if (session('resent'))
            <div class="alert alert-success mb-3 text-center" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
            @endif
            <p class="login-box-msg">
                {{ __('Before proceeding, please check your email for a verification link.') }}
                <br/>
                {{ __('If you did not receive the email') }},
            </p>
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-primary w-100">Verify</button>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->

@include('auth.inc.footer')
