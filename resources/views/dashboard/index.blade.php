@extends('welcome')
@section('title', 'Dashboard')
@section('content')
<div class="col-xxl-3 col-md-6 col-ssm-12 mb-30">
    <!-- Card 1 -->
    <div class="ap-po-details p-25 radius-xl bg-white d-flex justify-content-between">
        <div>
            <div class="overview-content">
                <h1><sup>Rp</sup>{{ number_format($totalSales, 2, '.', ',') }}</h1>
                <p>Sales</p>
            </div>

        </div>
        <div class="ap-po-timeChart">
            <div class="overview-single__chart d-md-flex align-items-end">
                <div class="parentContainer">


                    <div>
                        <canvas id="mychart8"></canvas>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- Card 1 End -->
</div>
<div class="col-xxl-3 col-md-6 col-ssm-12 mb-30">
    <!-- Card 2 End  -->
    <div class="ap-po-details p-25 radius-xl bg-white d-flex justify-content-between">
        <div>
            <div class="overview-content">
                <h1><sup>Rp</sup>{{ number_format($totalPurchases, 2, '.', ',') }}</h1>
                <p>Purchases</p>
            </div>

        </div>
        <div class="ap-po-timeChart">
            <div class="overview-single__chart d-md-flex align-items-end">
                <div class="parentContainer">


                    <div>
                        <canvas id="mychart9"></canvas>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- Card 2 End  -->
</div>
<div class="col-xxl-3 col-md-6 col-ssm-12 mb-30">
    <!-- Card 3 -->
    <div class="ap-po-details p-25 radius-xl bg-white d-flex justify-content-between">
        <div>
            <div class="overview-content">
                <h1><sup>Rp</sup>{{ number_format($totalProfit, 2, '.', ',') }}</h1>
                <p>Net. Profit</p>
            </div>

        </div>
        <div class="ap-po-timeChart">
            <div class="overview-single__chart d-md-flex align-items-end">
                <div class="parentContainer">


                    <div>
                        <canvas id="mychart10"></canvas>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- Card 3 End -->
</div>
<div class="col-xxl-6 mb-30">

    <div class="card broder-0">
        <div class="card-header">
            <h6>Total Revenue</h6>
        </div>
        <!-- ends: .card-header -->
        <div class="card-body pt-0">
            <div class="tab-content">
                <div class="tab-pane fade active show" id="tl_revenue-week" role="tabpanel" aria-labelledby="tl_revenue-week-tab">
                    <div class="revenue-labels">
                        <div>
                            <strong class="text-primary">
                                <sup>Rp</sup>{{ number_format($currentPeriodTransactions, 2, '.', ',') }}
                            </strong>
                            <span>Current Period</span>
                        </div>
                        <div>
                            <strong>
                                <sup>Rp</sup>{{ number_format($previousPeriodTransactions, 2, '.', ',') }}
                            </strong>
                            <span>Previous Period</span>
                        </div>
                    </div>
                    <!-- ends: .performance-stats -->

                    <div class="wp-chart">
                        <div class="parentContainer">
                            <div>
                                <canvas id="salesChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ends: .card-body -->
    </div>
</div>


<div class="col-xxl-6 mb-30">

    <div class="card border-0">
        <div class="card-header">
            <h6>Transactions</h6>
            <div class="card-extra">
                <div class="dropdown dropleft">
                    <a href="#" role="button" id="todo12" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span data-feather="more-horizontal"></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="todo12">
                        <a class="dropdown-item" href="{{ route('transactions.index') }}">See more</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="tab-content">
                <div class="tab-pane fade active show" id="s_revenue-today" role="tabpanel" aria-labelledby="s_revenue-today-tab">
                    <div class="table-responsive table-revenue">
                        <table class="table table--default">
                            <thead>
                                <tr>
                                    <th>Kode Trans.</th>
                                    <th>Produk</th>
                                    <th>Duration</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->order_code }}<br><span class="text-muted">{{ $transaction->customer->name }}</span></td>
                                    <td>{{ $transaction->product->name }}</td>
                                    <td>{{ $transaction->qty }} months</td>
                                    <td>Rp {{ number_format($transaction->price, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="col-xxl-8 mb-30">

    <div class="card border-0">
        <div class="card-header">
            <h6>Top Selling Products</h6>
            <div class="card-extra">
                <div class="dropdown dropleft">
                    <a href="#" role="button" id="todo12" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span data-feather="more-horizontal"></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="todo12">
                        <a class="dropdown-item" href="{{ route('transactions.index') }}">See more</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="tab-content">
                <div class="tab-pane fade active show" id="t_selling-today" role="tabpanel" aria-labelledby="t_selling-today-tab">
                    <div class="selling-table-wrap">
                        <div class="table-responsive">
                            <table class="table table--default">
                                <thead>
                                    <tr>
                                        <th>Nama Produk</th>
                                        <th>Harga Jual</th>
                                        <th>Harga Beli</th>
                                        <th>Pendapatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($topSellingProducts as $item)
                                    <tr>
                                        <td>{{ $item->product->name }}</td>
                                        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($item->cost, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($item->revenue, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<div class="col-xxl-4 mb-30">
    <div class="revenue-device-chart">

        <div class="card broder-0">
            <div class="card-header">
                <h6>Revenue By Products</h6>
            </div>
            <!-- ends: .card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="rb_device-today" role="tabpanel" aria-labelledby="rb_device-today-tab">
                        <div class="revenue-pieChart-wrap">


                            <div>
                                <canvas id="topSellingProductsChart"></canvas>
                            </div>


                        </div>
                        <div class="revenue-chart-legend-list">
                            @foreach ($topSellingProducts as $topProducts)
                            <div class="revenue-chart-legend d-flex justify-content-between">
                                <div class="revenue-chart-legend__label">
                                    <span class="label-dot dot-success"></span>
                                    <span>{{ $topProducts->product->name }}</span>
                                </div>
                                <div class="revenue-chart-legend__data">
                                    <span>Rp {{ number_format($topProducts->revenue, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- ends: .card-body -->
        </div>

    </div>
</div>
@endsection
@section('scripts')
<script>
var salesData = {!! json_encode($salesData) !!};
var ctx = document.getElementById('salesChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($sales->pluck('date')->toArray()) !!},
        datasets: [{
            label: 'Sales',
            data: salesData,
            borderColor: '#FA8B0C',
            tension: 0.1,
            fill: true, // Ubah menjadi true untuk area chart
            backgroundColor: 'rgba(250, 139, 12, 0.3)', // Warna latar belakang area
            pointBackgroundColor: '#FA8B0C',
            pointBorderColor: "#fff",
            pointHoverBorderColor: "#fff",
            pointBorderWidth: 2,
            pointHoverBorderWidth: 3,
            pointHoverRadius: 5,
            z: 5,
        },
        {
            label: 'Purchases',
            data: {!! json_encode([$currentPeriodPurchases, $previousPeriodPurchases]) !!},
            borderColor: '#3D7AFD',
            tension: 0.1,
            fill: true, // Ubah menjadi true untuk area chart
            backgroundColor: 'rgba(61, 122, 253, 0.3)', // Warna latar belakang area
            pointBackgroundColor: '#3D7AFD',
            pointBorderColor: "#fff",
            pointHoverBorderColor: "#fff",
            pointBorderWidth: 2,
            pointHoverBorderWidth: 3,
            pointHoverRadius: 5,
            z: 5,
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        },
        maintainAspectRatio: true,
        elements: {
            point: {
                radius: 5,
                z: 5,
            },
        },
        legend: {
            display: true,
            position: "bottom",
            labels: {
                boxWidth: 6,
                display: true,
                usePointStyle: true,
            },
        },
        hover: {
            mode: "index",
            intersect: false,
        },
    }
});

        // Data untuk chart top selling products
        var topSellingProductsData = {!! json_encode($topSellingProducts->pluck('revenue')->toArray()) !!};
        var topSellingProductsLabels = {!! json_encode($topSellingProducts->pluck('product.name')->toArray()) !!};

        // Buat chart baru menggunakan Chart.js
        var ctx = document.getElementById('topSellingProductsChart').getContext('2d');
        var topSellingProductsChart = new Chart(ctx, {
            type: 'pie', // Tipe chart (pie chart)
            data: {
                labels: topSellingProductsLabels, // Label untuk setiap bagian pie
                datasets: [{
                    label: 'Total Sales', // Label untuk dataset
                    data: Object.values(topSellingProductsData), // Data penjualan
                    backgroundColor: [ // Warna latar belakang untuk setiap bagian pie
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [ // Warna border untuk setiap bagian pie
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1 // Lebar border untuk setiap bagian pie
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true // Mulai sumbu y dari 0
                    }
                }
            }
        });

</script>
@endsection
