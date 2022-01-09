@section('page_name'){{ 'Home' }}@endsection

@include('main::inc.header')

<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="mb-auto">
        <div>
            <h3 class="float-md-start mb-0">{{env('TITLE')}}</h3>
            <nav class="nav nav-masthead justify-content-center float-md-end">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
            </nav>
        </div>
    </header>

    <main class="px-3">
        <h1>{{env('TITLE')}}</h1>
        @if (file_exists(base_path('.env.example')))
            <p class="lead">Go to <a href="{{Request::url()}}/install">{{Request::url()}}/install</a></p>
        @else
            <p class="lead">Welcome to my website.</p>
        @endif
        <p class="lead">
            <a href="https://d3vcms.d3vsoft.com" class="btn btn-lg btn-secondary fw-bold border-white bg-white">D3VCMS</a>
        </p>
    </main>

    <footer class="mt-auto text-white-50">
        <p>Powered by <a href="{{developer()}}">D3VSOFT</a></p>
    </footer>
</div>

@include('main::inc.footer')
