@section('page_name'){{ 'Users' }}@endsection

@include('admin.inc.header')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">@yield('page_name')
                        <a data-toggle="modal" data-target="#create_user">
                            <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top"
                                title="Create">
                                <i class="fas fa-user-plus"></i>
                            </button>
                        </a>
                    </h1>
                    <form action="{{route('admin.pages.users.create')}}" method="post" class="d-inline">
                        @csrf
                        <!-- Modal -->
                        <div class="modal fade" id="create_user" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Create user.</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="name">
                                                <span class="text-danger">*</span>
                                                Name</label>
                                            <input name="name" id="name" type="text" class="form-control"
                                                placeholder="Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">
                                                <span class="text-danger">*</span>
                                                Email</label>
                                            <input name="email" id="email" type="email" class="form-control"
                                                placeholder="Email" required>
                                        </div>
                                        <div class="form-group">
                                            <label>
                                                <span class="text-danger">*</span>
                                                Role</label>
                                            <select name="role" class="custom-select">
                                                <option value="NULL" selected>
                                                Member
                                                </option>
                                                @foreach ($roles as $role)
                                                <option value="{{$role->id}}">
                                                    {{$role->name}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">
                                                <span class="text-danger">*</span>
                                                Password</label>
                                            <input name="password" id="password" type="password" class="form-control"
                                                placeholder="Password" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password_confirmation">
                                                <span class="text-danger">*</span>
                                                Password Confirmation</label>
                                            <input name="password_confirmation" id="password_confirmation" type="password" class="form-control"
                                                placeholder="Password Confirmation" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">There are {{user_count()}} users.</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered m-0">
                                    <thead>
                                        <tr>
                                            <th class="align-middle" style="width: 0;">#</th>
                                            <th class="align-middle">Name</th>
                                            <th class="align-middle">Email</th>
                                            <th class="align-middle">Verified</th>
                                            <th class="align-middle">Role</th>
                                            <th class="align-middle">Registered</th>
                                            <th class="align-middle">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                        <tr>
                                            <td class="align-middle">
                                                {{$user->id}}
                                            </td>
                                            <td class="align-middle">
                                                {{$user->name}}
                                            </td>
                                            <td class="align-middle">
                                                {{$user->email}}
                                            </td>
                                            <td class="align-middle">
                                                {{email_verified_at($user->email_verified_at)}}
                                            </td>
                                            <td class="align-middle">
                                                {{role_name($user->role)}}
                                            </td>
                                            <td class="align-middle">
                                                {{$user->created_at}}
                                            </td>
                                            <td class="align-middle">
                                                <form action="{{route('admin.pages.users.delete')}}" method="post"
                                                    class="d-inline"
                                                    onclick="if(!confirm('Delete ({{$user->name}}).')){return false;}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$user->id}}">
                                                    <button class="btn btn-danger" data-toggle="tooltip"
                                                        data-placement="top" title="Delete">
                                                        <i class="fas fa-trash"></i></button>
                                                </form>
                                                <form action="{{route('admin.pages.users.edit')}}" method="post" class="d-inline">
                                                    @csrf
                                                    <a data-toggle="modal" data-target="#edit_user_{{$user->id}}">
                                                        <button type="button" class="btn btn-success"
                                                            data-toggle="tooltip" data-placement="top" title="Edit">
                                                            <i class="fas fa-user-edit"></i></button>
                                                    </a>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="edit_user_{{$user->id}}" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Edit
                                                                        <strong>{{$user->name}}</strong>.</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="id" value="{{$user->id}}">
                                                                    <div class="form-group">
                                                                        <label for="name">
                                                                            <span class="text-danger">*</span>
                                                                            Name</label>
                                                                        <input name="name" id="name" type="text" class="form-control"
                                                                            placeholder="Name"
                                                                            value="{{$user->name}}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="email">
                                                                            <span class="text-danger">*</span>
                                                                            Email</label>
                                                                        <input name="email" id="email" type="email" class="form-control"
                                                                            placeholder="Email"
                                                                            value="{{$user->email}}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>
                                                                            <span class="text-danger">*</span>
                                                                            Role</label>
                                                                        <select name="role" class="custom-select">
                                                                            <option value="0" @if ($user->role == NULL) selected @endif>
                                                                            Member
                                                                            </option>
                                                                            @foreach ($roles as $role)
                                                                            <option value="{{$role->id}}" @if ($user->role == $role->id) selected @endif>
                                                                                {{$role->name}}
                                                                            </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="password">
                                                                            Password</label>
                                                                        <input name="password" id="password" type="password" class="form-control"
                                                                            placeholder="Password">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="password_confirmation">
                                                                            Password Confirmation</label>
                                                                        <input name="password_confirmation" id="password_confirmation" type="password" class="form-control"
                                                                            placeholder="Password Confirmation">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Submit</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{$users->links()}}
                        </div>
                    </div><!-- /.container-fluid -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@include('admin.inc.footer')
