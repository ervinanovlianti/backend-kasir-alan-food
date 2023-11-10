<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $order = Order::create([
            'total' => $request->total,
            'uang_pembeli' => $request->uang_pembeli,
            'kembalian' => $request->kembalian,
        ]);

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
