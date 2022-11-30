@extends('admin.layouts.app', ['activePage' => 'other_faqs.list'])

@section('content')
    <div class="content">
        <section class="content-header">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Danh Sách câu hỏi khách hàng</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a class="text-fibo" href="#">QL câu hỏi khách hàng</a>
                                </li>
                                <li class="breadcrumb-item active">List</li>
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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Danh Sách câu hỏi khách hàng</h3>
                            </div>
                            <div class="card-body">
                                <form action="" method="GET">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="phoneSearch">Tên câu hỏi khách hàng</label>
                                                <input type="text" class="form-control" name="keySearch"
                                                    value="{{ @$info['keySearch'] }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="fromTo">Thời Gian</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" name="fromTo"
                                                        id="fromTo" value="{{ $info['fromTo'] }}" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="text-capitalize">Trạng Thái <sup
                                                        class="text-danger">*</sup></label>
                                                <select class="form-control select2" name="status" id="status">
                                                    <option value="">--- Chọn Trạng thái ---</option>
                                                    @foreach (config('global.default.status.orther_faqs') as $value)
                                                        <option value="{{ @$value['key'] }}"
                                                            {{ @$value['key'] == @$info['status'] ? 'selected' : '' }}>
                                                            {{ @$value['name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <button type="submit" class="btn btn-block btn-primary">Tìm Kiếm</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body table-responsive pt-0">
                                <div class="mb-3">Tổng số: <b> {{ $data->total() }} </b> records</div>
                                <table class="table table-bordered table-hover table-head-fixed">
                                    <thead>
                                        <tr>
                                            <th class="bg-info" style="width: 10px">#</th>
                                            <th class="text-center bg-info w-50">Câu hỏi</th>
                                            <th class="text-center bg-info">Email</th>
                                            <th class="text-center bg-info">Phone</th>
                                            <th class="text-center bg-info">Trạng thái</th>
                                            <th class="text-center bg-info">Ngày Tạo</th>
                                            <th class="text-center bg-info">Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $config_status = collect(config('global.default.status.orther_faqs'))->values();
                                            $keyBy = $config_status->keyBy('key');
                                            $label_delete = config('global.default.messages.orther_faqs.confirm_delete');
                                            $config_active = config('global.default.status.other_faqs.answered.key');
                                        @endphp
                                        @foreach ($data as $key => $item)
                                            <tr>
                                                <td class="align-middle" scope="row"> {{ $key + $data->firstItem() }}
                                                </td>
                                                <td class="align-middle">
                                                    {{ $item->consulting_content }}
                                                </td>
                                                <td class="align-middle">
                                                    {{ $item->email }}
                                                </td>
                                                <td class="align-middle text-center">
                                                    {{ $item->phone }}
                                                </td>
                                                <td class="align-middle text-center">
                                                    {{ @$keyBy[$item->status]['name'] }}
                                                </td>
                                                <td class="align-middle text-center">
                                                    {{ date_format(date_create($item->created_at), 'd-m-Y') }}</td>
                                                <td class="align-middle text-center">
                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ route('other_faqs.edit', ['id' => $item->id]) }}"
                                                        title="Xem thông tin">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    @php
                                                        $lablel = $item->status == $config_active ? 'Khóa câu hỏi khách hàng' : 'Mở khóa câu hỏi khách hàng';
                                                    @endphp
                                                    <button role="button" class="btn btn-sm btn-danger"
                                                        onclick="callAjax('{{ $item->id }}','{{ route('other_faqs.delete') }}', '{{ $label_delete }}')"
                                                        data-toggle="tooltip" title="{{ $lablel }}"><i
                                                            class="fas fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix text-right">
                                {{ $data->appends($info)->onEachSide(2)->links('vendor.pagination.custom') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script>
        $("#is_active").select2({
            theme: 'bootstrap4'
        });
        $('#fromTo').daterangepicker({
            autoUpdateInput: false,
            locale: {
                format: 'YYYY-MM-DD',
                cancelLabel: 'Clear'
            }
        });

        $('input[name="fromTo"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        });

        $('input[name="fromTo"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

        function callAjax(id_item, route, message = null) {
            var data = {
                itemId: id_item,
            };
            Swal.fire({
                title: message ?? 'Bạn có chắc khóa câu hỏi khách hàng này không?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Xác nhận',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.value) {
                    $('.loader').show();
                    $.ajax({
                        url: route,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        data: data,
                        success: function(response) {
                            $('.loader').hide();
                            if (response.status) {
                                Swal.fire({
                                    title: 'Thành công',
                                    text: response.message ?? 'Xử lý thành công',
                                    icon: response.icon ?? 'Success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Xác nhận'
                                }).then((result) => {
                                    if (result.value) {
                                        window.location.reload();
                                    }
                                })
                            } else {
                                toastr.error('Có lỗi xảy ra vui lòng thử lại sau.')
                            }
                        },
                        error: function(response) {
                            toastr.error('Có lỗi xảy ra vui lòng thử lại sau.')
                        }
                    });

                }
            })
        }
    </script>
@endsection
