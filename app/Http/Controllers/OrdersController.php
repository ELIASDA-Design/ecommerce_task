<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;
use App\Models\Order;

class OrdersController extends Controller
{
    public function show() {
        $orders_tmp = Order::with('products')->get();
        $orders = OrderResource::collection($orders_tmp)->toArray(request());
        return view('orders.show', compact('orders'));
    }

    public function showAddPage() {
        return view('orders.add');
    }

    public function create(Request $request) {
        $order = new Order();

        $track_code = "TR" . Str::random();

        $order->total = $request->input('total');
        $order->address = $request->input('address');
        $order->track_code = $track_code;
        $order->user_id = $request->input('user_id');

        try {
            $order->save();
            return redirect('/admin/dashboard/orders');
        } catch(Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function showEditPage($id) {
        $order = Order::where('id', $id)->first();

        return view('orders.edit', compact('order'));
    }

    public function edit(Request $request) {

        try {
            DB::table("orders")->where('id',$request->id)->update(array(
                "details" => $request->details,
                "total" => $request->total,
                "address" => $request->address
            ));
            return redirect('/admin/dashboard/orders');
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function delete(Request $request) {
        $order = Order::where('id', $request->id)->first();

        try {
            $order->delete();
            return redirect('/admin/dashboard/orders');
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
