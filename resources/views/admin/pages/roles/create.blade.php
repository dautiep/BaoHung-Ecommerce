@extends('admin.layouts.app', ['activePage' => 'users.create'])
@section('scripts')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugin/jquery-easyui-1.10.8/themes/default/easyui.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugin/jquery-easyui-1.10.8/themes/icon.css') }}">
    <script type="text/javascript" src="{{ asset('plugin/jquery-easyui-1.10.8/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugin/jquery-easyui-1.10.8/jquery.easyui.min.js') }}"></script>
    <style type="text/css">
        .tree-folder , .tree-file {
            background-image: none !important;
        }
    </style>
@endsection
@section('content')
    <div class="content">
        <section class="content-header">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            @if (empty(request()->id))
                                <h1 class="m-0">Thêm phân quyền</h1>
                            @else
                                <h1 class="m-0">Cập Nhật phân quyền</h1>
                            @endif
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a class="text-fibo" href="#">Service</a></li>
                                @if (empty(request()->id))
                                    <li class="breadcrumb-item active">Create</li>
                                @else
                                    <li class="breadcrumb-item active">Edit</li>
                                @endif

                            </ol>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('roles.store', ['id' => request()->id]) }}" method="POST">
                            @csrf
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Thông Tin phân quyền</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="text-capitalize">Tên phân quyền <sup
                                                        class="text-danger">*</sup></label>
                                                <input type="text" name="name" value="{{ old('name', @$data->name) }}"
                                                    class="form-control" placeholder="Tên phân quyền">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="easyui-panel" style="padding:40px 40px;">
                                        <div style="margin-bottom:20px">
                                            <input id="permission" name="permission[]"  class="easyui-combotree"
                                                data-options="url:'{{ route('roles.config') }}',method:'get',label:'Chọn quyền:',labelPosition:'top',multiple:true,value:{{ @$data->permission ?? '[]'}}"
                                                style="width:100%">
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <span><i>Lưu ý: Các trường có dấu <sup class="text-danger">*</sup> là các
                                                    trường bắt buộc nhập</i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">Lưu</button>
                                    <a href="{{ route('roles.list') }}" class="btn btn-primary ml-4">Trở Về</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script>
        $("#statusBlogCategory").select2({
            theme: 'bootstrap4'
        });
    </script>
@endsection
