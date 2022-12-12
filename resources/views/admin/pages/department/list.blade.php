@extends('admin.layouts.app', ['activePage' => 'department.list'])

@section('content')
    <div class="content">
        <section class="content-header">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <x-title-page :title="$title" :class="'m-0'" />
                        </div>
                        <div class="col-sm-6">
                            <x-breadcrumb />
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
                                <x-title-page :title="$title" :class="'card-title'" />
                            </div>
                            <div class="card-body">
                                <form action="" method="GET">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3">
                                            <x-input-control :input="'input'" :control="[
                                                'for' => 'name',
                                                'label' => 'Tên phòng ban',
                                                'type' => 'text',
                                                'class' => '',
                                                'name' => 'keySearch',
                                                'value' => $info['keySearch'],
                                                'property' => '',
                                            ]" />
                                        </div>
                                        <div class="col-md-3">
                                            <x-input-control :input="'calendar'" :control="[
                                                'for' => 'name',
                                                'label' => 'Thời Gian',
                                                'type' => 'text',
                                                'class' => '',
                                                'name' => 'fromTo',
                                                'value' => $info['fromTo'],
                                                'property' => '',
                                            ]" />
                                        </div>
                                        <div class="col-md-3">
                                            <x-input-control :input="'select2'" :control="[
                                                'for' => 'status',
                                                'label' => 'Trạng thái',
                                                'name' => 'status',
                                                'value' => $info['status'],
                                                'selected' => collect(
                                                    config('global.default.status.department'),
                                                )->values(),
                                                'first' => true,
                                                'first_value' => '',
                                                'first_name' => 'Xem tất cả',
                                                'id' => 'status',
                                            ]" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <a href="{{ route('department.create') }}"
                                                    class="btn btn-block btn-warning">Thêm
                                                    phòng ban</a>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <button type="submit" class="btn btn-block btn-primary">Tìm
                                                    Kiếm</button>
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
                                            <th class="text-center bg-info" style="width:35%">Tên</th>
                                            <th class="text-center bg-info">Số lượng thành viên</th>
                                            <th class="text-center bg-info">Trạng thái</th>
                                            <th class="text-center bg-info">Ngày Tạo</th>
                                            <th class="text-center bg-info">Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $config_status = collect(config('global.default.status.department'))->values();
                                            $keyBy = $config_status->keyBy('key');
                                            $label_delete = config('global.default.messages.orther_faqs.confirm_delete');
                                            $config_active = config('global.default.status.department.active.key');
                                            $bg_status = ['bg-warning', 'bg-success', 'bg-danger'];
                                        @endphp
                                        @foreach ($data as $key => $item)
                                            <tr>
                                                <td class="align-middle" scope="row"> {{ $key + $data->firstItem() }}
                                                </td>
                                                <td class="align-middle">
                                                    {{ $item->name }}
                                                </td>
                                                <td class="align-middle text-center">
                                                    {{ $item->total_users }}
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="badge {{ @$bg_status[$item->status] }}">
                                                        {{ @$keyBy[$item->status]['name'] }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    {{ date_format(date_create($item->created_at), 'd-m-Y') }}</td>
                                                <td class="align-middle text-center">
                                                    @if ($item->status == $config_active)
                                                        <a class="btn btn-sm btn-primary"
                                                            href="{{ route('department.edit', ['id' => $item->id]) }}"
                                                            title="Cập nhật thông tin">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    @endif
                                                    @php
                                                        $lablel = $item->status == $config_active ? 'Khóa phòng ban' : 'Mở khóa phòng ban ';
                                                    @endphp
                                                    <button role="button" class="btn btn-sm btn-warning"
                                                        onclick="cancelCategory('{{ $item->id }}', '{{ $lablel }}')"
                                                        data-toggle="tooltip" title="{{ $lablel }}"><i
                                                            class="fas fa-key"></i>
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
        $("#status").select2({
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

        function cancelCategory(id_item, message = null) {
            var data = {
                itemId: id_item,
            };
            Swal.fire({
                title: message ?? 'Bạn có chắc khóa nhóm quyền này không?',
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
                        url: "{{ route('department.state') }}",
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
