@extends('admin.layouts.app', ['activePage' => 'list-categories'])

@section('content')
<div class="content">
    <section class="content-header">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Danh Sách Danh Mục</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a class="text-fibo" href="#">Categories</a></li>
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
                            <h3 class="card-title">Danh Sách Danh Mục</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="GET">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="phoneSearch">Tên Danh Mục</label>
                                            <input type="text" class="form-control" name="categoryName" value="{{ $info['categoryName'] }}">
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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="phoneSearch">Trạng thái</label>
                                            <select class="form-control select2" name="categoryStatus" id="categoryStatus">
                                                <option value="">Tất cả</option>
                                                @foreach ($status as $item)
                                                    <option value="{{ $item['key'] }}" {{ ($info['categoryStatus'] == (string) $item['key']) ? 'selected' : '' }}>{{ $item['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <a href="{{ route('categories.create') }}" class="btn btn-block btn-warning">Thêm Danh Mục</a>
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
                            <div class="mb-3">Tổng số: <b> {{ $categories->total() }}   </b> records</div>
                            <table class="table table-bordered table-hover table-head-fixed">
                                <thead>
                                    <tr>
                                        <th class="bg-info" style="width: 10px">#</th>
                                        <th class="text-center bg-info w-50">Tên</th>
                                        <th class="text-center bg-info">Trạng thái</th>
                                        <th class="text-center bg-info">Ngày Tạo</th>
                                        <th class="text-center bg-info">Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $key => $category)
                                        <tr>
                                            <td class="align-middle" scope="row"> {{ $key + $categories->firstItem() }} </td>
                                            <td class="align-middle">
                                                {{ $category->name }}
                                            </td>
                                            <td class="align-middle text-center">
                                                @if ($category->status == $status[0]['key'])
                                                    <span class="badge bg-success">{{ $status[0]['name'] }}</span>
                                                @else
                                                    <span class="badge bg-danger">{{ $status[1]['name'] }}</span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">{{ date_format(date_create($category->created_at), 'd-m-Y') }}</td>
                                            <td class="align-middle text-center">

                                                @if ($category->status == $status[0]['key'])
                                                    <a class="btn btn-sm btn-primary" href="{{ route('categories.edit', $category->id) }}" title="Cập nhật thông tin">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button role="button" class="btn btn-sm btn-warning"
                                                            onclick="deactiveCategory('{{ $category->id }}')" data-toggle="tooltip"
                                                            title="{{ $status[0]['action'] }}"><i class="fa fa-key"></i>
                                                    </button>
                                                @else
                                                    <button role="button" class="btn btn-sm btn-success"
                                                            onclick="activeCategory('{{ $category->id }}')" data-toggle="tooltip"
                                                            title="{{ $status[1]['action'] }}"><i class="fa fa-key"></i>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix text-right">
                            {{ $categories->appends($info)->onEachSide(2)->links('vendor.pagination.custom') }}
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
        $("#categoryStatus").select2({
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

        function deactiveCategory(id_category) {
            var data = {
                categoryId: id_category,
                categoryStatus: 1
                };
            Swal.fire({
                title: 'Bạn có muốn khóa Danh Mục này không?',
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
                        url: "{{ route('categories.lock') }}",
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        type: 'POST',
                        data: data,
                        success: function(response) {
                            $('.loader').hide();
                            if (response.success == 'success') {
                                    Swal.fire({
                                    title: 'Thành công',
                                    text: "Đã khóa Danh Mục",
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

        function activeCategory(id_category) {
            var data = {
                categoryId: id_category,
                categoryStatus: 0
                };
            Swal.fire({
                title: 'Bạn có chắc muốn kích hoạt Danh Mục này không?',
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
                        url: "{{ route('categories.unlock') }}",
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        type: 'POST',
                        data: data,
                        success: function(response) {
                            $('.loader').hide();
                            if (response.success == 'success') {
                                    Swal.fire({
                                    title: 'Thành công',
                                    text: "Đã kích hoạt Danh Mục",
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

