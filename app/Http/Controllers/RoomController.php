<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\RoomCustomerTransaction;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('customers')->get();
        $transactions = Transaction::where('subscription_model','Purchase')->get();
        return view('rooms.index', compact('rooms','transactions'));
    }

    public function detail($roomId)
    {
        // Temukan room berdasarkan ID yang dikirimkan dari view blade
        $room = Room::findOrFail($roomId);

        // Ambil informasi detail tentang room, transaction, dan customer yang terkait dari tabel pivot
        $roomCustomerTransactions = RoomCustomerTransaction::where('room_id', $roomId)->get();

        // Inisialisasi array untuk menyimpan semua pelanggan yang terkait dengan ruangan
        $customers = [];

        // Iterasi melalui setiap entri RoomCustomerTransaction dan ambil pelanggan terkait
        foreach ($roomCustomerTransactions as $roomCustomerTransaction) {
            // Periksa apakah ada transaksi dan pelanggan yang terkait
            $transaction = $roomCustomerTransaction->transaction;
            $customer = $roomCustomerTransaction->customer;

            if ($transaction && $customer) {
                // Tambahkan pelanggan ke dalam array
                $customers[] = $customer;
            }
        }

        // Tampilkan view dengan semua informasi yang diperlukan
        return view('rooms.detail', compact('room', 'customers','transaction'));
        // return response()->json(['status'=>201, 'data'=>[
        //     'room'=>$room,
        //     'customers'=>$customers,
        //     'transaction'=>$transaction
        // ]]);
    }



    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        Room::create($request->all());
        return redirect()->route('rooms.index')->with('success', 'Room created successfully');
    }

    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $room->update($request->all());
        return redirect()->route('rooms.index')->with('success', 'Room updated successfully');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully');
    }
}