@extends('admin.layouts.master')

@section('title','Users')

@section('css')
    <link href="{{asset('assets/admin/css/plugins/summernote/summernote.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="main-content">
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>Users</strong></li>
        </ol>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <ul class="panel-tool-options">
                            <li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
                            <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
                            <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                            @if (session()->has('message'))
                                <div class="alert alert-info">
                                    <h4>{{session()->get('message')}}</h4>
                                </div>
                            @endif
                        <form action="{{isset($user->id) ? route('admin.users.update',$user->id) : route('admin.users.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @isset($user->id)
                                @method('PUT')
                            @endisset
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Mahmoud Mohamed" value="{{$user->name}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">email</label>
                                    <input type="text" name="email" class="form-control" id="email" placeholder="m.mohamed@cat.com.eg" value="{{$user->email}}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="email">Status</label>
                                    <select class="form-control" name="active">
                                        <option value="1" {{$user->active ? 'selected' : ''}}>Active</option>
                                        <option value="0" {{$user->active ? '' : 'selected'}}>DisActive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="password">password</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="*********">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="password_confirmation">confirm password</label>
                                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="*********">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="photo">Photo</label>
                                    <input type="file" name="photo" class="form-control" id="photo">
                                </div>
                            </div>
                            @isset($user->id)
                                <div class="col-lg-6">
                                    <img src="{{$user->photo}}" style="height: 200px;width: auto">
                                </div>
                            @endisset
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="summernote">BIO</label>
                                    <textarea name="bio" class="form-control ui-helper-hidden-accessible" id="summernote" >{!! $user->bio !!}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-8 col-sm-offset-4">
                                <a href="{{route('admin.users.index')}}" class="btn btn-white">Cancel</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!--Summernote Editor-->
    <script src="{{asset('assets/admin/js/plugins/summernote/summernote.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('#summernote').summernote({
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['fontsize', 'bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['color', ['color']],
                    ['para', ['style', 'ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['Misc', ['fullscreen', 'codeview', 'undo', 'redo']],
                    ['insert', ['table', 'hr']]
                ],
                height: 260,                 // set editor height
                minHeight: null,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor
                focus: true                  // set focus to editable area after initializing summernote
            });

            $('.ui-helper-hidden-accessible').hide();


        });



    </script>
@endsection
