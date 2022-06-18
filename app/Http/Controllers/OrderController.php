<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function create_order(Request $request)
    {
        $order_created = Order::insert([
            'title' => $request->title,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);

        return response()->json([
            'msg' => 'Order created'
        ],201);
    }

    public function destroy($id)
    {
        $order_deleted = Order::findOrFail($id);
        $order_deleted->delete();
        return response()->json([
            'msg' => 'Order deleted'
        ],401);
    }
}
