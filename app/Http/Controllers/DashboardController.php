<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\FinancialReport;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use App\Models\Supplier;

class DashboardController extends Controller
{
    public function index()
    {
        $transactions = Transaction::orderBy('transaction_date','desc')->paginate(5);
        $customers = Customer::all();
        $products = Product::all();
        $suppliers = Supplier::all();
        // Ringkasan Kinerja
        $totalSales = FinancialReport::sum('total_revenue');
        $totalPurchases = FinancialReport::sum('total_cost');
        $totalProfit = $totalSales - $totalPurchases;
        $sales = Transaction::select(
            DB::raw("DATE_FORMAT(transaction_date, '%Y-%m-%d') as date"), DB::raw("SUM(price) as total"))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $salesData = $sales->pluck('total')->toArray();

        // Data Pelanggan
        $totalCustomers = Customer::count();
        $newCustomersCount = Customer::whereDate('created_at', Carbon::today())->count();

        // Pelanggan dengan pembelian terbanyak
        $topBuyingCustomers = Transaction::with('customer')
            ->has('customer') // Pastikan setiap transaksi memiliki pelanggan terkait
            ->select('customer_id', DB::raw('COUNT(*) as total_transactions'))
            ->groupBy('customer_id')
            ->orderByDesc('total_transactions')
            ->take(5)
            ->get();

        // Data Produk
        $totalProducts = Product::count();
        $topSellingProducts = Transaction::select('product_id', DB::raw('COUNT(*) as total_sales'))
            ->groupBy('product_id')
            ->orderByDesc('total_sales')
            ->take(5)
            ->get();

        // Data Transaksi
$currentPeriodStart = Carbon::now()->startOfMonth();
$currentPeriodEnd = Carbon::now()->endOfMonth();
$previousPeriodStart = Carbon::now()->subMonth()->startOfMonth();
$previousPeriodEnd = Carbon::now()->subMonth()->endOfMonth();

$currentPeriodTransactions = Transaction::whereBetween('transaction_date', [$currentPeriodStart, $currentPeriodEnd])->sum('price');
$previousPeriodTransactions = Transaction::whereBetween('transaction_date', [$previousPeriodStart, $previousPeriodEnd])->sum('price');

$currentPeriodSales = Transaction::whereBetween('transaction_date', [$currentPeriodStart, $currentPeriodEnd])->where('subscription_model','Sales')->sum('price');
$previousPeriodSales = Transaction::whereBetween('transaction_date', [$previousPeriodStart, $previousPeriodEnd])->where('subscription_model','Sales')->sum('price');

$currentPeriodPurchases = Transaction::whereBetween('transaction_date', [$currentPeriodStart, $currentPeriodEnd])->where('subscription_model','Purchase')->sum('price');
$previousPeriodPurchases = Transaction::whereBetween('transaction_date', [$previousPeriodStart, $previousPeriodEnd])->where('subscription_model','Purchase')->sum('price');


        $totalTransactions = Transaction::count();
        $averageTransactionValue = FinancialReport::avg('balance');

        // Data Produk
$totalProducts = Product::count();
$topSellingProducts = Transaction::where('subscription_model','Sales')->with('product')->select('product_id', DB::raw('COUNT(*) as total_sales'))
    ->groupBy('product_id')
    ->orderByDesc('total_sales')
    ->take(5)
    ->get();

// Tambahkan informasi harga jual (price), harga beli (cost), dan pendapatan (revenue) untuk setiap produk
foreach ($topSellingProducts as $product) {
    $productData = Product::find($product->product_id);
    if ($productData) {
        $product->price = $productData->price;
        $product->cost = $productData->cost;
    } else {
        // Handle case when product is not found
        $product->price = 0;
        $product->cost = 0;
    }

    $product->revenue = Transaction::where('product_id', $product->product_id)
        ->where('subscription_model', 'Sales')
        ->sum('price');
}

        return view('dashboard.index', compact(
            'totalSales',
            'salesData',
            'sales',
            'totalPurchases',
            'totalProfit',
            'totalCustomers',
            'newCustomersCount',
            'topBuyingCustomers',
            'totalProducts',
            'topSellingProducts',
            'totalTransactions',
            'averageTransactionValue',
            'currentPeriodTransactions',
            'previousPeriodTransactions',
            'currentPeriodSales',
    'previousPeriodSales',
    'currentPeriodPurchases',
    'previousPeriodPurchases',
    'transactions',
    'customers',
    'suppliers',
    'products',
    'topSellingProducts',
        ));
    }
    }