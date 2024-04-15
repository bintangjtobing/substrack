<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('name','asc')->get();
        // Inisialisasi array untuk menyimpan total pendapatan per pelanggan
        $customerEarnings = [];

        // Iterasi melalui setiap pelanggan
        foreach ($customers as $customer) {
            // Hitung total pendapatan untuk pelanggan tertentu
            $totalEarnings = Transaction::where('customer_id', $customer->id)->sum(DB::raw('price * qty'));

            // Simpan total pendapatan dalam array dengan kunci sebagai ID pelanggan
            $customerEarnings[$customer->id] = $totalEarnings;
        }
        return view('customers.index', compact('customers','customerEarnings'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        Customer::create($request->all());
        return redirect()->route('customers.index')->with('success', 'Customer created successfully');
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $customer->update($request->all());
        return redirect()->route('customers.index')->with('success', 'Customer updated successfully');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully');
    }
}
