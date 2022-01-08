@include('install.inc.header')

<div class="login-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="#" class="h1"><b>D3VCMS</b> Install</a>
        </div>
        <div class="card-body">
            <p class="text-center">Fill in all the blanks.</p>

            <form action="{{route('install.1')}}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label for="db_connection">DB_CONNECTION</label>
                    <select class="form-control" name="db_connection" id="db_connection">
                        <option value="mysql">MySQL</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="db_host">DB_HOST</label>
                    <input type="text" class="form-control" name="db_host" id="db_host" placeholder="DB_HOST">
                </div>
                <div class="form-group mb-3">
                    <label for="db_port">DB_PORT</label>
                    <input type="text" class="form-control" name="db_port" id="db_port" placeholder="DB_PORT">
                </div>
                <div class="form-group mb-3">
                    <label for="db_database">DB_DATABASE</label>
                    <input type="text" class="form-control" name="db_database" id="db_database" placeholder="DB_DATABASE">
                </div>
                <div class="form-group mb-3">
                    <label for="db_username">DB_USERNAME</label>
                    <input type="text" class="form-control" name="db_username" id="db_username" placeholder="DB_USERNAME">
                </div>
                <div class="form-group mb-3">
                    <label for="db_password">DB_PASSWORD</label>
                    <input type="text" class="form-control" name="db_password" id="db_password" placeholder="DB_PASSWORD">
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Next</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>

@include('install.inc.footer')
