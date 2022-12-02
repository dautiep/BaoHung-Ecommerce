@extends('admin.layouts.app', ['activePage' => 'users.create'])

@section('content')
    <div class="content">
        <section class="content-header">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            @if (empty(request()->id))
                                <h1 class="m-0">Thêm Tài khoản</h1>
                            @else
                                <h1 class="m-0">cập Nhật Tài khoản</h1>
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
                        <form action="{{ route('users.store', ['id' => request()->id]) }}" method="POST">
                            @csrf
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Thông Tin Tài khoản</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="text-capitalize">Tên Tài khoản <sup
                                                        class="text-danger">*</sup></label>
                                                <input type="text" name="name" value="{{ old('name', @$data->name) }}"
                                                    class="form-control" placeholder="Tên Tài khoản">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="text-capitalize">Email Tài khoản <sup
                                                        class="text-danger">*</sup></label>
                                                <input type="text" name="email"
                                                    value="{{ old('email', @$data->email) }}" class="form-control"
                                                    placeholder="Email Tài khoản">
                                            </div>
                                        </div>
                                    </div>
                                    @if (empty(@$data))
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="text-capitalize">Nhập Password Tài khoản <sup
                                                            class="text-danger">*</sup></label>
                                                    <div class="input-group" id="show_hide_password">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><a href=""><i
                                                                        class="fa fa-eye-slash"
                                                                        aria-hidden="true"></i></a></span>
                                                        </div>
                                                        <input class="form-control" type="password" name="password"
                                                            value="{{ old('password') }}" placeholder="Password Tài khoản">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <x-input-control :input="'select2'" :control="[
                                                'for' => 'department_id',
                                                'label' => 'Phòng ban',
                                                'name' => 'department_id',
                                                'value' => @$data->department_id,
                                                'selected' => @$department,
                                                'required' => true,
                                                'first' => false,
                                                'first_value' => '',
                                                'first_name' => 'Tất cả',
                                                'id' => 'department_id',
                                            ]" />
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="text-capitalize">Chọn nhóm quyền quản lý<sup
                                                        class="text-danger">*</sup></label>
                                                <select name="groups[]" id="groups" class="select2"
                                                    data-placeholder="Chọn thẻ" style="width: 100%;">
                                                    <option value="">--- Chọn nhóm quyền quản lý ---</option>
                                                    @php
                                                        $collect_group = @$data->groups ? @$data->groups->pluck('id')->toArray() : [];
                                                    @endphp
                                                    @foreach ($groups as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ in_array($item->id, old('groups', $collect_group ?: [])) ? 'selected' : '' }}>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
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
                                    <a href="{{ route('users.list') }}" class="btn btn-primary ml-4">Trở Về</a>
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
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("fa-eye-slash");
                    $('#show_hide_password i').removeClass("fa-eye");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("fa-eye-slash");
                    $('#show_hide_password i').addClass("fa-eye");
                }
            });
        });
    </script>
    <script>
        $("#groups").select2({
            theme: 'bootstrap4'
        });
        $('#department_id').select2({
            theme: 'bootstrap4'
        });
        $("#statusBlogCategory").select2({
            theme: 'bootstrap4'
        });
    </script>
@endsection
