@extends('welcome')
@section('title', 'Dashboard')
@section('content')
    <!-- Ringkasan Kinerja -->
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Ringkasan Kinerja</h5>
                <p>Total Penjualan: Rp {{ $totalSales }}</p>
                <p>Total Pembelian: Rp {{ $totalPurchases }}</p>
                <p>Total Laba Bersih: Rp {{ $totalProfit }}</p>
            </div>
        </div>
    </div>

    <!-- Grafik Tren Pendapatan -->
    <div class="col-lg-8 col-md-6 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Grafik Tren Pendapatan</h5>
                <div>{!! $salesChart->container() !!}</div>
            </div>
        </div>
    </div>

    <!-- Data Pelanggan -->
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data Pelanggan</h5>
                <p>Jumlah Pelanggan Baru: {{ $newCustomersCount }}</p>
                <p>Jumlah Total Pelanggan: {{ $totalCustomers }}</p>
            </div>
        </div>
    </div>

    <!-- Grafik Pelanggan Baru -->
    <div class="col-lg-8 col-md-6 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Grafik Pelanggan Baru</h5>
                <div>{!! $newCustomersChart->container() !!}</div>
            </div>
        </div>
    </div>

    <!-- Pelanggan dengan Pembelian Terbanyak -->
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Pelanggan dengan Pembelian Terbanyak</h5>
                <ul>
                    @foreach ($topBuyingCustomers as $topCustomer)
                        <li>{{ $topCustomer->customer->name }} - {{ $topCustomer->total_transactions }} transaksi</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Data Produk -->
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data Produk</h5>
                <p>Jumlah Produk: {{ $totalProducts }}</p>
            </div>
        </div>
    </div>

    <!-- Grafik Penjualan Produk Teratas -->
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Grafik Penjualan Produk Teratas</h5>
                <div>{!! $productsChart->container() !!}</div>
            </div>
        </div>
    </div>

    <!-- Data Transaksi -->
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data Transaksi</h5>
                <p>Total Transaksi: {{ $totalTransactions }}</p>
                <p>Rata-rata Nilai Transaksi: {{ $averageTransactionValue }}</p>
            </div>
        </div>
    </div>

    <!-- Grafik Jumlah Transaksi -->
    <div class="col-lg-8 col-md-6 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Grafik Transaksi</h5>
                <div>{!! $transactionsChart->container() !!}</div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {!! $salesChart->script() !!}
    {!! $newCustomersChart->script() !!}
    {!! $productsChart->script() !!}
    {!! $transactionsChart->script() !!}
@endsection
