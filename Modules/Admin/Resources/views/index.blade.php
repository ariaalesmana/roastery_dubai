@extends('admin::layouts.app')

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item active">Dashboard</li>
</ol>
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-4 col-lg-4">
                <div class="card text-white bg-danger">
                    <div class="card-body pb-0">
                        <div class="text-value">{{ count_vendor(Auth::user())['all'] }}</div>
                        <div>Vendor</div>
                    </div>
                    <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
                        <canvas class="chart" id="card-chart4" height="70"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-lg-4">
                <div class="card text-white bg-primary">
                    <div class="card-body pb-0">
                        <div class="text-value">{{ count_customer(Auth::user())['all'] }}</div>
                        <div>Customer</div>
                    </div>
                    <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
                        <canvas class="chart" id="card-chart-cust" height="70"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-lg-4">
                <div class="card text-white bg-warning">
                    <div class="card-body pb-0">
                        <div class="text-value">{{ count_product(Auth::user()) }}</div>
                        <div>Produk</div>
                    </div>
                    <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
                        <canvas height="70"></canvas>
                    </div>
                </div>
            </div>
        </div>
        {{--<div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">Traffic</h4>
                        <div class="small text-muted">November 2017</div>
                    </div>
                    <div class="col-sm-7 d-none d-md-block">
                        <button class="btn btn-primary float-right" type="button">
                            <i class="icon-cloud-download"></i>
                        </button>
                        <div class="btn-group btn-group-toggle float-right mr-3" data-toggle="buttons">
                            <label class="btn btn-outline-secondary">
                                <input id="option1" type="radio" name="options" autocomplete="off"> Day
                            </label>
                            <label class="btn btn-outline-secondary active">
                                <input id="option2" type="radio" name="options" autocomplete="off" checked=""> Month
                            </label>
                            <label class="btn btn-outline-secondary">
                                <input id="option3" type="radio" name="options" autocomplete="off"> Year
                            </label>
                        </div>
                    </div>
                </div>
                <div class="chart-wrapper" style="height:300px;margin-top:40px;">
                    <canvas class="chart" id="main-chart" height="300"></canvas>
                </div>
            </div>
        </div>--}}
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('assets/node_modules/chart.js/dist/Chart.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/@coreui/coreui-plugin-chartjs-custom-tooltips/dist/js/custom-tooltips.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script>
    @foreach ($errors->all() as $error)
        toastr.error("{{$error}}")
    @endforeach

    var table_product = null;
    table_product =  $('#tabel-product').DataTable({
        lengthChange: false,
        searching: false, 
        paging:   false,
        ordering: true,
        info:     false
    })
    
    function prosesDelete(status, id) {
        if(status == 0) {
            $('#forms').append(`<input type="hidden" name="vendor_master_id" value="` + id + `">`);
            showAlertSubmit('Perhatian', 'Apakah anda yakin akan menghapus vendor?', document.getElementById('forms'), true);
        } else {
            showAlertSubmit('Perhatian', 'Vendor masih aktif, anda harus menonaktifkan vendor terlebih dahulu', document.getElementById('forms'), false);
        }
    }

    var cardChart4 = new Chart($('#card-chart4'), {
        type: 'bar',
        data: {
            labels: ['Aktif', 'Tidak Aktif'],
            datasets: [{
            label: 'Vendor',
            backgroundColor: 'rgba(255,255,255,.2)',
            borderColor: 'rgba(255,255,255,.55)',
            data: [{{ count_vendor(Auth::user())['aktif'] }}, {{ count_vendor(Auth::user())['tidak_aktif'] }}]
            }]
        },
        options: {
            maintainAspectRatio: false,
            legend: {
            display: false
            },
            scales: {
            xAxes: [{
                display: false,
                barPercentage: 0.6
            }],
            yAxes: [{
                display: false
            }]
            }
        }
    });

var cardChartCust = new Chart($('#card-chart-cust'), {
    type: 'bar',
    data: {
        labels: ['Aktif', 'Tidak Aktif'],
        datasets: [{
        label: 'Vendor',
        backgroundColor: 'rgba(255,255,255,.2)',
        borderColor: 'rgba(255,255,255,.55)',
        data: [{{ count_customer(Auth::user())['aktif'] }}, {{ count_vendor(Auth::user())['tidak_aktif'] }}]
        }]
    },
    options: {
        maintainAspectRatio: false,
        legend: {
        display: false
        },
        scales: {
        xAxes: [{
            display: false,
            barPercentage: 0.6
        }],
        yAxes: [{
            display: false
        }]
        }
    }
});
</script>
@endpush