<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\FinancialReport;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use App\Charts\SalesChart;
use App\Charts\PurchasesChart;
use App\Charts\NewCustomersChart;
use App\Charts\TopSellingProductsChart;
use App\Charts\TransactionsChart;

class DashboardController extends Controller
{
    public function index()
    {
        // Ringkasan Kinerja
        $totalSales = FinancialReport::sum('total_revenue');
        $totalPurchases = FinancialReport::sum('total_cost');
        $totalProfit = $totalSales - $totalPurchases;

        // Grafik tren pendapatan dan pengeluaran dari waktu ke waktu
        $salesChart = $this->getSalesChart();
        $purchasesChart = $this->getPurchasesChart();

        // Data Pelanggan
        $totalCustomers = Customer::count();
        $newCustomersCount = Customer::whereDate('created_at', Carbon::today())->count();
        $newCustomersChart = $this->getNewCustomersChart();

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
        $productsChart = $this->getProductsChart();

        // Data Transaksi
        $totalTransactions = Transaction::count();
        $averageTransactionValue = FinancialReport::avg('balance');
        $transactionsChart = $this->getTransactionsChart();

        return view('dashboard.index', compact(
            'totalSales',
            'totalPurchases',
            'totalProfit',
            'salesChart',
            'purchasesChart',
            'totalCustomers',
            'newCustomersCount',
            'newCustomersChart',
            'topBuyingCustomers',
            'totalProducts',
            'topSellingProducts',
            'productsChart',
            'totalTransactions',
            'averageTransactionValue',
            'transactionsChart'
        ));
        // return response()->json([
        //     'status'=>200,
        //     'data'=>[
        //         'totalSales'=>$totalSales,
        //         'totalPurchases'=>$totalPurchases,
        //         'totalProfit'=>$totalProfit,
        //         'salesChart'=>$salesChart,
        //         // 'purchasesChart'=>$purchasesChart,
        //         'totalCustomers'=>$totalCustomers,
        //         'newCustomersCount'=>$newCustomersCount,
        //         'newCustomersChart'=>$newCustomersChart,
        //         'topBuyingCustomers'=>$topBuyingCustomers,
        //         'totalProducts'=>$totalProducts,
        //         'topSellingProducts'=>$topSellingProducts,
        //         // 'productsChart'=>$productsChart,
        //         'totalTransactions'=>$totalTransactions,
        //         'averageTransactionValue'=>$averageTransactionValue,
        //         // 'transactionsChart'=>$transactionsChart,
        //     ],
        //     'message'=>'Data retrieved',
        // ]);
    }

    private function getSalesChart()
    {
        $sales = Transaction::select(DB::raw("DATE_FORMAT(transaction_date, '%Y-%m-%d') as date"), DB::raw("SUM(price) as total"))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $chart = new SalesChart;

        $chart->title('Sales Trend')
            ->labels($sales->pluck('date'))
            ->dataset('Total Sales', 'line', $sales->pluck('total'))
            ->color('rgba(243, 206, 24, 1)')->backgroundColor('rgba(243, 206, 24, 0.3)')
            ->options([
                'responsive' => true,
            ]);

        return $chart;
    }


    private function getPurchasesChart()
    {
        $purchases = FinancialReport::select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"), DB::raw("SUM(total_cost) as total"))
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        $chart = new PurchasesChart;

        $chart->title('Purchases Trend')
            ->labels($purchases->pluck('month'))
            ->dataset('Total Purchases', 'line', $purchases->pluck('total'))
            ->options([
                'responsive' => true,
            ]);

        return $chart;
    }

    private function getNewCustomersChart()
    {
        $newCustomers = Transaction::join('customers', 'transactions.customer_id', '=', 'customers.id')
            ->select(DB::raw("DATE_FORMAT(transactions.transaction_date, '%Y-%m-%d') as date"), DB::raw("COUNT(customers.id) as count"))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $chart = new NewCustomersChart;

        $chart->title('New Customers Trend')
            ->labels($newCustomers->pluck('date'))
            ->dataset('New Customers', 'line', $newCustomers->pluck('count'))
            ->backgroundColor('rgba(5, 35, 73, 0.3)')->color('rgba(5, 35, 73, 1)')
            ->options([
                'responsive' => true,
            ]);

        return $chart;
    }
    private function getProductsChart()
{
    $products = Transaction::join('products', 'transactions.product_id', '=', 'products.id')
        ->select('products.name', DB::raw('COUNT(*) as sales_count'))
        ->groupBy('products.name')
        ->orderByDesc('sales_count')
        ->take(5)
        ->get();

    $chart = new TopSellingProductsChart;

    $chart->title('Top Selling Products')
        ->labels($products->pluck('name'))
        ->dataset('Total Sales', 'bar', $products->pluck('sales_count'))
        ->backgroundColor('rgba(5, 35, 73, 0.3)')->color('rgba(5, 35, 73, 1)')
        ->options([
            'responsive' => true,
        ]);

    return $chart;
}

private function getTransactionsChart()
{
    // Mengambil data penjualan
    $sales = FinancialReport::select(DB::raw("DATE_FORMAT(transaction_date, '%Y-%m-%d') as date"), DB::raw("SUM(total_revenue) as sales"))
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();

    // Mengambil data pembelian
    $purchases = FinancialReport::select(DB::raw("DATE_FORMAT(transaction_date, '%Y-%m-%d') as date"), DB::raw("SUM(total_cost) as purchases"))
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();

    // Menggabungkan data penjualan dan pembelian berdasarkan tanggal
    $mergedData = $sales->map(function ($item, $key) use ($purchases) {
        $purchase = $purchases->where('date', $item->date)->first();
        return [
            'date' => $item->date,
            'sales' => $item->sales,
            'purchases' => $purchase ? $purchase->purchases : 0,
        ];
    });

    $chart = new TransactionsChart;
    $chart->title('Transactions Trend');
    $chart->labels($mergedData->pluck('date'));
    $chart->dataset('Sales', 'line', $mergedData->pluck('sales')->toArray())->color('rgba(243, 206, 24, 1)')->backgroundColor('rgba(243, 206, 24, 0.3)');
    $chart->dataset('Purchases', 'line', $mergedData->pluck('purchases')->toArray())->backgroundColor('rgba(5, 35, 73, 0.3)')->color('rgba(5, 35, 73, 1)');

    return $chart;
}







}
