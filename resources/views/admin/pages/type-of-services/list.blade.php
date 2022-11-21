@extends('admin.layouts.app', ['activePage' => 'list-blog-categories'])

@section('content')
<div class="content">
    <section class="content-header">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Danh Sách Dịch Vụ</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a class="text-fibo" href="#">Services</a></li>
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
                            <h3 class="card-title">Danh Sách Dịch Vụ</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="GET">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="phoneSearch">Tên Dịch Vụ</label>
                                            <input type="text" class="form-control" name="nameCategory" value="{{ $info['serviceName'] }}">
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
                                                <input type="text" class="form-control float-right" name="fromTo" id="fromTo" value="{{$info['fromTo']}}" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <a href="{{ route('services.create') }}" class="btn btn-block btn-warning">Thêm Dịch Vụ</a>
                                        </div>
                                    </div>
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
                            <div class="mb-3">Tổng số: <b> {{ $services->total() }}   </b> records</div>
                            <table class="table table-bordered table-hover table-head-fixed">
                                <thead>
                                    <tr>
                                        <th class="bg-info" style="width: 10px">#</th>
                                        <th class="text-center bg-info w-50">Tên</th>
                                        <th class="text-center bg-info">Ngày Tạo</th>
                                        <th class="text-center bg-info">Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($services as $key => $service)
                                        <tr>
                                            <td class="align-middle" scope="row"> {{ $key + $services->firstItem() }} </td>
                                            <td class="align-middle">
                                                {{ $service->name }}
                                            </td>
                                            <td class="align-middle text-center">{{ date_format(date_create($service->created_at), 'H:i:s d-m-Y') }}</td>
                                            <td class="align-middle text-center">
                                                <a class="btn btn-sm btn-primary" href="" title="Cập nhật thông tin">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button role="button" class="btn btn-sm btn-danger"
                                                        onclick="cancelCategory('{{ $service->id }}')" data-toggle="tooltip"
                                                        title="Xóa dịch vụ"><i class="fas fa-times"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix text-right">
                            {{ $services->appends($info)->onEachSide(2)->links() }}
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

        function cancelCategory(id_service) {
            var data = {
                serviceId: id_service,
                };
            Swal.fire({
                title: 'Bạn có chắc xóa dịch vụ này không?',
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
                        url: "{{ route('services.delete') }}",
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        type: 'POST',
                        data: data,
                        success: function(response) {
                            $('.loader').hide();
                            if (response.success == 0) {
                                    Swal.fire({
                                    title: 'Thành công',
                                    text: "Đã xóa danh mục",
                                    icon: 'success',
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

