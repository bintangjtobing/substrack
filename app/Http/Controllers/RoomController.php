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
        $roomCustomerTransaction = RoomCustomerTransaction::where('room_id', $roomId)->first();

        // Periksa apakah ada roomCustomerTransaction yang terkait dengan ruangan ini
        if ($roomCustomerTransaction) {
            $transaction = $roomCustomerTransaction->transaction;
            $customer = $roomCustomerTransaction->customer;

            // Periksa apakah ada transaksi dan pelanggan yang terkait
            if ($transaction && $customer) {
                return view('rooms.detail', compact('room', 'transaction', 'customer'));
            } else {
                // Tambahkan penanganan jika tidak ada transaksi atau pelanggan yang terkait dengan roomCustomerTransaction
                return redirect()->back()->with('error', 'No transaction or customer found for this room');
            }
        } else {
            // Tambahkan penanganan jika tidak ada roomCustomerTransaction yang terkait dengan ruangan
            return redirect()->back()->with('error', 'No RoomCustomerTransaction found for this room');
        }
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
