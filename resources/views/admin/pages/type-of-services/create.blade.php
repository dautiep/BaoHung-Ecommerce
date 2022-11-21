@extends('admin.layouts.app', ['activePage' => 'list-blog-categories'])

@section('content')
<div class="content">
    <section class="content-header">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        @if (empty($service))
                            <h1 class="m-0">Thêm Dịch Vụ</h1>
                        @else
                            <h1 class="m-0">cập Nhật Dịch Vụ</h1>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a class="text-fibo" href="#">Service</a></li>
                            @if (empty($service))
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
                    @if (empty($service))
                        <form action="{{ route('services.store') }}" method="POST">
                            @csrf
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Thông Tin Dịch Vụ</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="text-capitalize">Tên Dịch Vụ <sup class="text-danger">*</sup></label>
                                                <input type="text" name="serviceName" value="{{ old('serviceName') }}" class="form-control" placeholder="Kiến thức liên quan">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <span><i>Lưu ý: Các trường có dấu <sup class="text-danger">*</sup> là các trường bắt buộc nhập</i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">Lưu</button>
                                    <a href="{{ route("services.list") }}" class="btn btn-primary ml-4">Trở Về</a>
                                </div>
                            </div>
                        </form>
                    @else
                    <form action="{{ route('blog.category.update', $service->id) }}" method="POST">
                        @csrf
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Thông Tin Dịch Vụ</h3>
                            </div>
                            <div class="card-body">
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="text-capitalize">Tên Dịch Vụ <sup class="text-danger">*</sup></label>
                                            <input type="text" name="serviceName" value="{{ $service->name }}" class="form-control" placeholder="Kiến thức liên quan">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="text-capitalize">Trạng Thái <sup class="text-danger">*</sup></label>
                                            <select class="form-control select2" name="statusBlogCategory" id="statusBlogCategory">
                                                <option value="">--- Chọn status ---</option>
                                                @foreach ($listStatus as $value)
                                                    <option value="{{ $value }}" {{ ($value == $service->status) ? 'selected' : '' }}>{{ App\Enums\EStatusBlogCategory::valueToString($value) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <span><i>Lưu ý: Các trường có dấu <sup class="text-danger">*</sup> là các trường bắt buộc nhập</i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Lưu</button>
                                <a href="{{ route("blog.category.list") }}" class="btn btn-primary ml-4">Trở Về</a>
                            </div>
                        </div>
                    </form>
                    @endif

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




