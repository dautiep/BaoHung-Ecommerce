@extends('admin.layouts.app', ['activePage' => 'other_faqs.list'])

@section('content')
    <div class="content">
        <section class="content-header">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            @if (empty(request()->id))
                                <h1 class="m-0">Thêm Tư Vấn</h1>
                            @else
                                <h1 class="m-0">Cập Nhật Tư Vấn</h1>
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
                        <form action="{{ route('other_faqs.content_to_consult', ['id' => request()->id]) }}" method="POST">
                            @csrf
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Thông Tin Tư Vấn</h3>
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
                                    @if (is_admin() && @$status_unanswered['key'] == $data->status)
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <x-input-control :input="'select2'" :control="[
                                                    'for' => 'assigned_partment_id',
                                                    'label' => 'Phòng phụ trách',
                                                    'name' => 'assigned_partment_id',
                                                    'value' => @$data->department_id_responsibility,
                                                    'selected' => @$department_assign,
                                                    'first' => true,
                                                    'first_value' => '',
                                                    'first_name' => 'Chọn phòng ban',
                                                    'id' => 'status',
                                                ]" />
                                            </div>
                                        </div>
                                    @endif

                                    @if (!is_admin() && is_can(['faq.assignUser']) && !empty($data->department_id_responsibility))
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <x-input-control :input="'select2'" :control="[
                                                    'for' => 'assigned_user_id',
                                                    'label' => 'Người phụ trách',
                                                    'name' => 'assigned_user_id',
                                                    'value' => @$data->user_id,
                                                    'selected' => @$users_assign,
                                                    'first' => true,
                                                    'first_value' => '',
                                                    'first_name' => 'Chọn người dùng',
                                                    'id' => 'status',
                                                ]" />
                                            </div>
                                        </div>
                                    @endif


                                    @php
                                        $config_status = collect(config('global.default.status.orther_faqs'))->values();
                                        $keyBy = $config_status->keyBy('key');
                                        $status_unanswered = config('global.default.status.orther_faqs.unanswered');
                                        $status_answered = config('global.default.status.orther_faqs.answered');
                                    @endphp

                                    @if (@$status_unanswered['key'] == $data->status || @$status_answered['key'] == $data->status)
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <label class="text-capitalize">Câu trả lời <sup
                                                        class="text-danger">*</sup></label>
                                                <textarea type="text" {{ @$status_answered['key'] == $data->status ? 'readonly' : '' }} name="content_to_consult"
                                                    class="form-control">{{ old('content_to_consult', @$data->content_to_consult) }}</textarea>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <x-required-field-note />
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    @if (@$status_unanswered['key'] == $data->status)
                                        <button type="submit" class="btn btn-success">Lưu</button>
                                    @endif

                                    <a href="{{ route('other_faqs.list') }}" class="btn btn-primary ml-4">Trở
                                        Về</a>
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
        $("#status").select2({
            theme: 'bootstrap4'
        });
        $('#assigned_user_id').select2({
            theme: 'bootstrap4'
        });
    </script>
@endsection
