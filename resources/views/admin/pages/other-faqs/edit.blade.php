@extends('admin.layouts.app', ['activePage' => 'other_faqs.edit'])

@section('content')
    <div class="content">
        <section class="content-header">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            @if (empty(request()->id))
                                <h1 class="m-0">Thêm Câu Hỏi</h1>
                            @else
                                <h1 class="m-0">Cập Nhật Câu Hỏi</h1>
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
                        <form action="{{ route('groups.store', ['id' => request()->id]) }}" method="POST">
                            @csrf
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Thông Tin Câu Hỏi</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="text-capitalize">Số điện thoại tư vấn <sup
                                                        class="text-danger">*</sup></label>
                                                <input type="text" name="phone"
                                                    value="{{ old('phone', @$data->phone) }}" class="form-control"
                                                    placeholder="Số điện thoại tư vấn" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="text-capitalize">Email tư vấn <sup
                                                        class="text-danger">*</sup></label>
                                                <input type="text" name="email"
                                                    value="{{ old('email', @$data->email) }}" class="form-control"
                                                    placeholder="Email tư vấn" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="text-capitalize">Nội dung tư vấn <sup
                                                        class="text-danger">*</sup></label>
                                                <input type="text" name="consulting_content"
                                                    value="{{ old('consulting_content', @$data->consulting_content) }}"
                                                    class="form-control" placeholder="Nội dung tư vấn" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="text-capitalize">Thời gian <sup
                                                        class="text-danger">*</sup></label>
                                                <input type="text" name="created_date"
                                                    value="{{ old('created_date', date_format(date_create(@$data->created_date), 'd-m-Y H:i:s')) }}"
                                                    class="form-control" placeholder="Thời gian" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $config_status = collect(config('global.default.status.orther_faqs'))->values();
                                        $keyBy = $config_status->keyBy('key');
                                    @endphp
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="text-capitalize">Trạng thái Câu Hỏi <sup
                                                        class="text-danger">*</sup></label>
                                                <input type="text" name="status"
                                                    value="{{ old('status', @$keyBy[@$data->status]['name']) }}"
                                                    class="form-control" placeholder="Trạng Thái Câu Hỏi" readonly>
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
                                    <a href="{{ route('groups.list') }}" class="btn btn-primary ml-4">Trở Về</a>
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
        $("#roles").select2({
            theme: 'bootstrap4'
        });
    </script>
@endsection
