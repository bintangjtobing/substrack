<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomCustomerTransaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::orderBy('created_at','desc')->paginate(10);
        $customers = Customer::all();
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('transactions.index', compact('transactions','customers','products','suppliers'));
    }

    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        // Memeriksa apakah produk dipilih
        if ($request->filled('product_id')) {
            // Mengambil data produk berdasarkan ID
            $product = Product::find($request->product_id);

            // Menyimpan data transaksi
            if ($product) {
                // Tambahkan logika validasi room di sini jika diperlukan
                // ...

                $transaction = new Transaction([
                    'transaction_date' => $request->transaction_date,
                    'customer_id' => $request->customer_id,
                    'supplier_id' => $product->supplier_id,
                    'product_id' => $product->id,
                    'subscription_model' => 'Sales',
                    'price' => $request->price,
                    'qty' => $request->qty,
                ]);

                $transaction->save();

                return redirect()->route('transactions.index')->with('success', 'Transaction created successfully');
            } else {
                // Memberikan tanggapan jika produk tidak ditemukan
                return redirect()->back()->with('error', 'Selected product not found.');
            }
        } else {
            // Menyimpan data transaksi pembelian
            $transaction = new Transaction([
                'transaction_date' => $request->transaction_date,
                'customer_id' => $request->customer_id,
                'supplier_id' => $request->supplier_id, // Kosongkan jika transaksi pembelian
                'product_id' => null, // Kosongkan jika transaksi pembelian
                'subscription_model' => 'Purchase', // Tambahkan informasi pembelian
                'price' => $request->price, // Tentukan harga secara manual
                'qty' => $request->qty,
            ]);

            $transaction->save();

            return redirect()->route('transactions.index')->with('success', 'Purchase transaction created successfully');
        }
    }




    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        $customers = Customer::all();
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('transactions.edit', compact('transaction', 'customers', 'products', 'suppliers'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $transaction->update($request->all());
        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully');
    }
}