@section('page_name'){{ 'Posts' }}@endsection

@include('admin.inc.header')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">@yield('page_name')
                        <a data-toggle="modal" data-target="#create">
                            <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top"
                                title="Create">
                                <i class="fas fa-user-plus"></i>
                            </button>
                        </a>
                    </h1>
                    <form action="{{route('admin.pages.posts.create')}}" method="post" class="d-inline">
                        @csrf
                        <!-- Modal -->
                        <div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Create post.</h5>
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
                                            <label for="text">
                                                <span class="text-danger">*</span>
                                                Text</label>
                                            <textarea class="form-control" name="text" id="text" rows="10" placeholder="Text" required></textarea>
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
                            <h3 class="card-title">There are {{$posts->total()}} posts.</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="align-middle" style="width: 0;">#</th>
                                            <th class="align-middle">Name</th>
                                            <th class="align-middle">Created</th>
                                            <th class="align-middle">Updated</th>
                                            <th class="align-middle">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($posts as $post)
                                            <tr>
                                                <td class="align-middle">
                                                    {{$post->id}}
                                                </td>
                                                <td class="align-middle">
                                                    {{$post->name}}
                                                </td>
                                                <td class="align-middle">
                                                    {{$post->created_at}}
                                                </td>
                                                <td class="align-middle">
                                                    {{$post->updated_at}}
                                                </td>
                                                <td class="align-middle">
                                                    <form action="{{route('admin.pages.posts.delete')}}" method="post"
                                                        class="d-inline"
                                                        onclick="if(!confirm('Delete ({{$post->id}}).')){return false;}">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{$post->id}}">
                                                        <button class="btn btn-danger" data-toggle="tooltip"
                                                            data-placement="top" title="Delete">
                                                            <i class="fas fa-trash"></i></button>
                                                    </form>
                                                    <form action="{{route('admin.pages.posts.edit')}}" method="post" class="d-inline">
                                                        @csrf
                                                        <a data-toggle="modal" data-target="#edit{{$post->id}}">
                                                            <button type="button" class="btn btn-success"
                                                                data-toggle="tooltip" data-placement="top" title="Edit">
                                                                <i class="fas fa-user-edit"></i></button>
                                                        </a>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="edit{{$post->id}}" tabindex="-1"
                                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Edit
                                                                            <strong>#{{$post->id}}</strong></h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <input type="hidden" name="id" value="{{$post->id}}">
                                                                        <div class="form-group">
                                                                            <label for="edit_name">
                                                                                <span class="text-danger">*</span>
                                                                                Name</label>
                                                                            <input name="name" id="edit_name" type="text" class="form-control"
                                                                                placeholder="Name"
                                                                                value="{{$post->name}}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="text">
                                                                                <span class="text-danger">*</span>
                                                                                Text</label>
                                                                            <textarea class="form-control" name="text" id="text" rows="10" placeholder="Text" required>{{$post->text}}</textarea>
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
                            {{$posts->links()}}
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
