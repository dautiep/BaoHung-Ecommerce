@extends('admin.layouts.app', ['activePage' => 'dashboard'])
@section('title', 'Trang Chủ')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            @foreach ($countQuestions as $count)
                @if ($count->status == config('global.default.status.orther_faqs.answered.key'))
                    <div class="col-md-3">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3> {{ $count->total ?? 0 }} </h3>
                                <p>Tổng câu hỏi đã xử lý</p>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($count->status == config('global.default.status.orther_faqs.unanswered.key'))
                    <div class="col-md-3">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3> {{ $count->total ?? 0 }} </h3>
                                <p>Tổng câu hỏi chưa xử lý</p>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($count->status == config('global.default.status.orther_faqs.refuses_answer.key'))
                    <div class="col-md-3">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3> {{ $count->total ?? 0 }} </h3>
                                <p>Tổng câu hỏi đã khóa</p>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Biểu đồ thống kê</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body float-right">
                                <form class="form-inline">
                                    <div class="form-group mx-sm-3 mb-2">
                                        <select class="form-control" name="time" id="timeshow">
                                            <option value="7" selected>7 ngày trước</option>
                                            <option value="10">10 ngày trước</option>
                                            <option value="15">15 ngày trước</option>
                                            <option value="30">30 ngày trước</option>
                                            <option value="GETTIME">Chọn thời gian</option>
                                        </select>
                                    </div>
                                    <div class="form-group mx-sm-3 mb-2 searchData d-none">
                                        <div class="form-group">
                                            <label class="mr-3">Thời gian</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control float-right" id="reservation">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" onclick="getDataChart()"
                                        class="btn btn-primary mb-2 searchData d-none">Thực hiện
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="chart">
                                    <!-- Sales Chart Canvas -->
                                    <canvas id="chartDate" height="100%"></canvas>
                                </div>
                                <!-- /.chart-responsive -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="description-block border-right">
                                    <h5 class="description-header" id="total_imei">{{ $info['total_all_questions']}}</h5>
                                    <span class="description-text">Tổng số</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                        </div>
                        <input type="text" hidden class="d-none" id="labels_" value="{{implode(',', $info['labels_'])}}">
                        <input type="text" hidden class="d-none" id="data_questions" value="{{implode(',', $info['data_questions'])}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="{{ asset('admin/admin-lte/plugins/chart.js/Chart.min.js') }}"></script>
<script>
    $(document).ready(function() {
        showChart();
    });
    $('#reservation').daterangepicker({
        locale: {
            format: 'DD-MM-YYYY'
        }
    });
    $("#timeshow").change(function() {
        var timeshow = $('#timeshow').val();
        if (timeshow == 'GETTIME') {
            $('.searchData').removeClass('d-none');
            return false;
        } else {
            $('.searchData').addClass('d-none');
            getDataChart();
        }
    });

    $('.closeShowAds').click(function() {
        $('.dialog-ads').removeClass('show');
    });

    function getDataChart() {
        var timeshow = $('#timeshow').val();
        var from_date, to_date, from_to = '';
        if (timeshow == 'GETTIME') {
            from_to = $('#reservation').val().split('/').join('-');
            var res = from_to.split(" - ");
            from_date = res[0];
            to_date = res[1];
        } else {
            from_date = LastNDays(timeshow);
            to_date = LastNDays(0);
        }
        var data = {
            from_date: from_date,
            to_date: to_date,
        };
        $('.loader').show();
        $.ajax({
            url: "{{ route('dashboard.get.data.chart') }}",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type: 'POST',
            data: data,
            success: function(response) {
                $('.loader').hide();
                if (response.error == 0) {
                    $('#labels_').val(response.data.labels_);
                    $('#data_questions').val(response.data.data_questions);

                    $('#total_imei').text(response.data.total_imei);
                    showChart();
                } else {
                    $('#labels_').val('');
                    $('#data_questions').val('');

                    $('#total_imei').text(0);
                    toastr.error('Có lỗi xảy ra vui lòng thử lại sau.')
                }
            },
            error: function(response) {
                toastr.error('Có lỗi xảy ra vui lòng thử lại sau.')
            }
        });
    }

    function showChart() {
        $('#chartDate').remove(); // this is my <canvas> element
        $('.chart').append('<canvas id="chartDate" height="100%"><canvas>');
        var ctxDate = document.getElementById('chartDate');
        var imeiChartDate = new Chart(ctxDate, {
            type: 'bar',
            data: {
                labels : $('#labels_').val().split(","),
                datasets: [
                    {
                        label: "Câu hỏi",
                        backgroundColor: "#00524e ",
                        data:  $('#data_questions').val().split(",")
                    }
                ]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Thống Kê Câu Hỏi Khách Hàng'
                }
            }
        });
    }

    function LastNDays(number) {
        var d = new Date();
        d.setDate(d.getDate() - number);
        return d.getFullYear() + "-" + ('0' + (d.getMonth() + 1)).slice(-2) + "-" + ('0' + d.getDate()).slice(-2);
    }
</script>
@endsection
