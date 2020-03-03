@extends('admin.layouts.master')

@section('title','Users')

@section('content')
    <div class="main-content">
        <h1 class="page-title">Users</h1>
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>Users</strong></li>
        </ol>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="alert alert-success sr-only" id="showResultChange">
                            <h4>Change Successfully</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>email</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rows as $row)
                                    <tr class="gradeX">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->email}}</td>
                                        <td>
                                            <select name="type" class="form-control changeUserType" data-id="{{$row->id}}">
                                                <option value="1" {{$row->type == 1 ? 'selected' : ''}}>admin</option>
                                                <option value="2" {{$row->type == 2 ? 'selected' : ''}}>speaker</option>
                                                <option value="3" {{$row->type == 3 ? 'selected' : ''}}>attendee</option>
                                            </select>
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $row->active == 1 ? 'success' : 'danger' }}">{{ $row->active == 1 ? 'Active' : 'DisActive'}}</span>
                                        </td>
                                        <td class="size-80">
                                            <div class="dropdown">
                                                <a href="" data-toggle="dropdown" class="more-link"><i class="icon-dot-3 ellipsis-icon"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a href="{{route('admin.users.edit',$row->id)}}">Edit</a></li>
                                                    <li><a href="{{route('admin.users.destroy',$row->id)}}">Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                {!! $rows->links() !!}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
    $(document).on('change','.changeUserType',function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        let type = $(this).val();
        $.ajax({
            data:{id:id,type:type},
            success:function (result) {
                if (result.status == true)
                {
                    $('#showResultChange').removeClass('sr-only')
                    setInterval(function () {
                        $('#showResultChange').addClass('sr-only')
                    },2000)
                }
            },
            error:function (errors) {
                console.log(errors);
            }
        });
    });
</script>
@endsection
