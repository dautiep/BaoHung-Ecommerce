@extends('admin.layouts.app', ['activePage' => 'list-products'])

@section('content')
<div class="content">
    <section class="content-header">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Danh Sách Sản Phẩm</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a class="text-fibo" href="#">Products</a></li>

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
                            <h3 class="card-title">Danh Sách Sản Phẩm</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="GET">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="phoneSearch">Tên Sản Phẩm</label>
                                            <input type="text" class="form-control" name="productName" value="{{ $info['productName'] }}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="phoneSearch">Danh Mục Sản Phẩm</label>
                                            <select class="form-control select2" name="productCategory" id="productCategory">
                                                <option value="">Tất cả</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ ($info['productCategory'] == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
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
                                            <select class="form-control select2" name="productStatus" id="productStatus">
                                                <option value="">Tất cả</option>
                                                @foreach ($status as $item)
                                                    <option value="{{ $item['key'] }}" {{ ($info['productStatus'] == (string) $item['key']) ? 'selected' : '' }}>{{ $item['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <a href="{{ route('products.create') }}" class="btn btn-block btn-warning">Thêm Sản Phẩm</a>
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
                            <div class="mb-3">Tổng số: <b> {{ $products->total() }}   </b> records</div>
                            <table class="table table-bordered table-hover table-head-fixed">
                                <thead>
                                    <tr>
                                        <th class="bg-info" style="width: 10px">#</th>
                                        <th class="text-center bg-info w-40">Thông tin</th>
                                        <th class="text-center bg-info img-product">Hình Ảnh</th>
                                        <th class="text-center bg-info">Trạng thái</th>
                                        <th class="text-center bg-info">Ngày Tạo</th>
                                        <th class="text-center bg-info">Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $key => $product)
                                        <tr>
                                            <td class="align-middle" scope="row"> {{ $key + $products->firstItem() }} </td>
                                            <td class="align-middle">
                                                Tên: {{ $product->name }} <br>
                                                Danh mục: {{ $product->category->name }} <br>
                                                @if ($product->price == 'Liên hệ')
                                                    Giá: {{ $product->price }}
                                                @else
                                                    Giá: {{ number_format($product->price) }} VND
                                                @endif
                                            </td>
                                            <td class="text-center"><img class="img-fluid img-product-item" src="{{ asset('admin/images/products/' .'/'. $product->image_url) }}" alt="{{ $product->name }}"></td>
                                            <td class="align-middle text-center">
                                                @if ($product->status == $status['actived']['key'])
                                                    <span class="badge bg-success">{{ $status['actived']['name'] }}</span>
                                                @else
                                                    <span class="badge bg-danger">{{ $status['unactived']['name'] }}</span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">{{ date_format(date_create($product->created_at), 'd-m-Y') }}</td>
                                            <td class="align-middle text-center">

                                                @if ($product->status == $status['actived']['key'])
                                                    <a class="btn btn-sm btn-primary" href="{{ route('products.edit', $product->id) }}" title="Cập nhật thông tin">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button role="button" class="btn btn-sm btn-warning"
                                                            onclick="deactiveService('{{ $product->id }}')" data-toggle="tooltip"
                                                            title="{{ $status['actived']['action'] }}"><i class="fa fa-key"></i>
                                                    </button>
                                                @else
                                                    <button role="button" class="btn btn-sm btn-success"
                                                            onclick="activeService('{{ $product->id }}')" data-toggle="tooltip"
                                                            title="{{ $status['unactived']['action'] }}"><i class="fa fa-key"></i>
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
                            {{ $products->appends($info)->onEachSide(2)->links('vendor.pagination.custom') }}
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
        $("#productStatus").select2({
            theme: 'bootstrap4'
        });

        $("#productCategory").select2({
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

        function deactiveService(id_product) {
            var data = {
                productId: id_product,
                productStatus: 1
                };
            Swal.fire({
                title: 'Bạn có muốn ngừng kinh doanh sản phẩm này không?',
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
                        url: "{{ route('products.lock') }}",
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        type: 'POST',
                        data: data,
                        success: function(response) {
                            $('.loader').hide();
                            if (response.success == 'success') {
                                    Swal.fire({
                                    title: 'Thành công',
                                    text: "Đã ngừng kinh doanh",
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

        function activeService(id_product) {
            var data = {
                productId: id_product,
                productStatus: 0
                };
            Swal.fire({
                title: 'Bạn có chắc muốn kinh doanh sản phẩm này không?',
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
                        url: "{{ route('products.unlock') }}",
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        type: 'POST',
                        data: data,
                        success: function(response) {
                            $('.loader').hide();
                            if (response.success == 'success') {
                                    Swal.fire({
                                    title: 'Thành công',
                                    text: "Đã kích hoạt kinh doanh sản phẩm",
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

