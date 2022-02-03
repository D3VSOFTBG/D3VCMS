@section('page_name'){{ 'Settings' }}@endsection

@include('admin.inc.header')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <form action="{{route('admin.pages.settings')}}" method="post" enctype="multipart/form-data">
        @csrf
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('page_name') <button type="submit" class="btn btn-primary"
                                data-toggle="tooltip" data-placement="top" title="Save"><i
                                    class="fas fa-save"></i></button></h1>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card card-warning card-outline">
                            <div class="card-header">
                                <h5 class="m-0">General</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">
                                        <span class="text-danger">*</span>
                                        Title</label>
                                    <input name="title" id="title" type="text" class="form-control" placeholder="Title" value="{{$settings['TITLE']}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="title_seperator">
                                        <span class="text-danger">*</span>
                                        Title Seperator</label>
                                    <input name="title_seperator" id="title_seperator" type="text" class="form-control"
                                        placeholder="Title Seperator" value="{{$settings['TITLE_SEPERATOR']}}" required>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <span class="text-danger">*</span>
                                        Env</label>
                                    <select name="app_env" class="custom-select">
                                        <option value="production" @if(env('APP_ENV') == 'production') selected @endif>Production</option>
                                        <option value="local" @if(env('APP_ENV') == 'local') selected @endif>Local</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card card-warning card-outline">
                            <div class="card-header">
                                <h5 class="m-0">Users</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>
                                        <span class="text-danger">*</span>
                                        User registration</label>
                                    <select name="user_registration" class="custom-select">
                                        <option value="1" @if(setting('USER_REGISTRATION') == 1) selected @endif>Yes</option>
                                        <option value="0" @if(setting('USER_REGISTRATION') == 0) selected @endif>No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-warning card-outline">
                            <div class="card-header">
                                <h5 class="m-0">Images</h5>
                            </div>
                            <div class="card-body">
                                <div class="input-group">
                                    <div class="card dark-mode w-100">
                                        <label for="image" class="card-header"><span class="text-danger">*</span>
                                            Favicon</label>
                                        <div class="card-body">
                                            <p class="card-text">
                                                <img class="responsive" src="{{asset('/storage/img/global/' . $settings['FAVICON'])}}" alt="Image">
                                            </p>
                                            <input name="favicon" type="file" class="form-control-file" id="favicon" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <div class="card dark-mode w-100">
                                        <label for="image" class="card-header"><span class="text-danger">*</span>
                                            Logo</label>
                                        <div class="card-body">
                                            <p class="card-text">
                                                <img class="responsive" src="{{asset('/storage/img/global/' . $settings['LOGO'])}}" alt="Image">
                                            </p>
                                            <input name="logo" type="file" class="form-control-file" id="logo" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-warning card-outline">
                            <div class="card-header">
                                <h5 class="m-0">Mail</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="mail_driver">
                                        <span class="text-danger">*</span>
                                        Mail Driver</label>
                                    <select name="mail_driver" class="custom-select">
                                        <option value="smtp" @if(setting('MAIL_DRIVER') == 'smtp') selected @endif>SMTP</option>
                                        <option value="sendmail" @if(setting('MAIL_DRIVER') == 'sendmail') selected @endif>Sendmail</option>
                                        <option value="mailgun" @if(setting('MAIL_DRIVER') == 'mailgun') selected @endif>Mailgun</option>
                                        <option value="ses" @if(setting('MAIL_DRIVER') == 'ses') selected @endif>Ses</option>
                                        <option value="log" @if(setting('MAIL_DRIVER') == 'log') selected @endif>Log</option>
                                        <option value="array" @if(setting('MAIL_DRIVER') == 'array') selected @endif>Array</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="mail_host">
                                        <span class="text-danger">*</span>
                                        Mail Host</label>
                                    <input name="mail_host" id="mail_host" type="text" class="form-control"
                                        placeholder="Mail Host" value="{{setting('MAIL_HOST')}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="mail_port">
                                        <span class="text-danger">*</span>
                                        Mail Port</label>
                                    <input name="mail_port" id="mail_port" type="text" class="form-control"
                                        placeholder="Mail Port" value="{{setting('MAIL_PORT')}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="mail_username">
                                        <span class="text-danger">*</span>
                                        Mail Username</label>
                                    <input name="mail_username" id="mail_username" type="text" class="form-control"
                                        placeholder="Mail Username" value="{{setting('MAIL_USERNAME')}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="mail_password">
                                        <span class="text-danger">*</span>
                                        Mail Password</label>
                                    <input name="mail_password" id="mail_password" type="password" class="form-control"
                                        placeholder="Mail Password" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="mail_encryption">
                                        <span class="text-danger">*</span>
                                        Mail Encryption</label>
                                    <input name="mail_encryption" id="mail_encryption" type="text" class="form-control"
                                        placeholder="Mail Encryption" value="{{setting('MAIL_ENCRYPTION')}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="mail_from_address">
                                        <span class="text-danger">*</span>
                                        Mail From Address</label>
                                    <input name="mail_from_address" id="mail_from_address" type="email" class="form-control"
                                        placeholder="Mail From Address" value="{{setting('MAIL_FROM_ADDRESS')}}" required>
                                </div>
                            </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </form>
</div>
<!-- /.content-wrapper -->

@include('admin.inc.footer')
