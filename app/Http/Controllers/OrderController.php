<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class OrderController extends Controller
{
    // public function store(Request $request)
    // {
    //     // Validasi data pesanan
    //     $validatedData = $request->validate([
    //         // Aturan validasi di sini
    //     ]);

    //     // Mulai transaksi database
    //     DB::beginTransaction();

    //     try {
    //         // Simpan order ke dalam tabel orders
    //         $order = Order::create([
    //             'tanggal' => now(),
    //             // Tambahkan kolom-kolom lain yang sesuai dengan tabel orders Anda
    //         ]);

    //         // Simpan order items ke dalam tabel order_items
    //         foreach ($validatedData['items'] as $item) {
    //             OrderItem::create([
    //                 'order_id' => $order->id,
    //                 'menu_id' => $item['menu_id'],
    //                 'quantity' => $item['quantity'],
    //                 'harga' => $item['harga'],
    //                 // Tambahkan kolom-kolom lain yang sesuai dengan tabel order_items Anda
    //             ]);
    //         }

    //         // Hitung total pesanan
    //         $total = 1; // Hitung total pesanan di sini

    //             // Simpan total pesanan ke dalam tabel orders
    //             $order->update([
    //                 'total' => $total,
    //             ]);

    //         // Hitung kembalian jika diperlukan
    //         $uangPembeli = $validatedData['uangPembeli'];
    //         $kembalian = $uangPembeli - $total;

    //         // Selesaikan transaksi
    //         DB::commit();

    //         return response()->json([
    //             'message' => 'Pesanan berhasil disimpan',
    //             'kembalian' => $kembalian,
    //         ], 200);
    //     } catch (\Exception $e) {
    //         // Rollback transaksi jika terjadi kesalahan
    //         DB::rollback();

    //         return response()->json([
    //             'message' => 'Gagal menyimpan pesanan',
    //         ], 500);
    //     }
    // }

    // public function store(Request $request)
    // {
    //     // Validasi data pesanan jika diperlukan

    //     // Simpan data pesanan ke tabel 'orders'
    //     $order = new Order();
    //     $order->total_amount = $request->input('total_amount');
    //     $order->save();

    //     // Simpan detail pesanan ke tabel 'order_items'
    //     foreach ($request->input('order_items') as $item) {
    //         $orderItem = new OrderItem();
    //         $orderItem->menu_id = $item['menu_id'];
    //         $orderItem->quantity = $item['quantity'];
    //         $orderItem->order_id = $order->id;
    //         $orderItem->save();
    //     }

    //     return response()->json(['message' => 'Pesanan berhasil disimpan.', 'order_id' => $order->id]);
    // }

    public function store(Request $request)
    {
        // Validasi request jika diperlukan

        // Simpan data pesanan ke tabel 'orders'
        $order = Order::create([
            'total' => $request->total,
            'uang_pembeli' => $request->uang_pembeli,
            'kembalian' => $request->kembalian,
        ]);

        // Simpan detail pesanan ke tabel 'order_items'
        foreach ($request->order_items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $item['menu_id'],
                'quantity' => $item['quantity'],
            ]);
        }

        // return response()->json(['message' => 'Pesanan berhasil disimpan'], 200);
        return response()->json(['message' => 'Pesanan berhasil disimpan', 'order_id' => $order->id]);
    }


}
