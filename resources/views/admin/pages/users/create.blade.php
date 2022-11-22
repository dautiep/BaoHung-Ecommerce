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
                                                <input type="text" name="name" value="{{ old('name') }}"
                                                    class="form-control" placeholder="Tên Tài khoản">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="text-capitalize">Email Tài khoản <sup
                                                        class="text-danger">*</sup></label>
                                                <input type="text" name="email" value="{{ old('email') }}"
                                                    class="form-control" placeholder="Email Tài khoản">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="text-capitalize">Password Tài khoản <sup
                                                        class="text-danger">*</sup></label>
                                                <input type="password" name="password" value="{{ old('email') }}"
                                                    class="form-control" placeholder="Email Tài khoản">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="text-capitalize">Trạng Thái <sup
                                                        class="text-danger">*</sup></label>
                                                <select class="form-control select2" name="is_active"
                                                    id="is_active">
                                                    <option value="">--- Chọn status ---</option>
                                                    @foreach (config('global.default.status.users') as $value)
                                                        <option value="{{ @$value['key'] }}"
                                                            {{ @$value == @$service->status ? 'selected' : '' }}>
                                                            {{ @$value['name'] }}
                                                        </option>
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
        $("#statusBlogCategory").select2({
            theme: 'bootstrap4'
        });
    </script>
@endsection
