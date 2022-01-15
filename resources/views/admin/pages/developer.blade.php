@section('page_name'){{ 'Developer' }}@endsection

@include('admin.inc.header')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">@yield('page_name')</h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h5 class="m-0">@yield('page_name')</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.pages.developer')}}" method="post" onsubmit="return confirm('Clear entire cache.');">
                                @csrf
                                <button class="btn btn-primary w-100">Clear entire cache.</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@include('admin.inc.footer')
