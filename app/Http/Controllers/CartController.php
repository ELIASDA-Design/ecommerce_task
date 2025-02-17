<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Throwable;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }


    public function show()
    {
        $products = Product::all();
        return view('products.cart', compact('products'));
    }

    public function addToCart(Request $request)
    {
        $this->cartService->addItem($request->product_id, $request->quantity, $request->price, $request->name);
        // Set toast message
        session()->flash('toast', [
            'type' => 'success',
            'message' => 'Product added to cart!',
        ]);
        return redirect()->back();
    }

    public function removeFromCart(Request $request)
    {
        $this->cartService->removeItem($request->product_id);
        session()->flash('toast', [
            'type' => 'success',
            'message' => 'Product removed from cart!',
        ]);
        return redirect()->back();
    }

    public function updateCart(Request $request)
    {
        $this->cartService->updateItem($request->product_id, $request->quantity);
        session()->flash('toast', [
            'type' => 'success',
            'message' => 'Product update in cart!',
        ]);
        return response()->json([
            'success' => true
        ]);
    }

    public function viewCart()
    {
        $cart = $this->cartService->getCart();
        $total = $this->cartService->getTotal();
        return view('products.cart', compact('cart', 'total'));
    }

    public function clearCart()
    {
        $this->cartService->clearCart();
        session()->flash('toast', [
            'type' => 'success',
            'message' => 'Cart has been cleared!',
        ]);
        return redirect()->back();
    }

    public function checkout(Request $request) {
        $cart = $this->cartService->getCart();
        $total = $this->cartService->getTotal();

        $order = new Order();

        $track_code = "TR" . Str::random();

        $order->total = $total;
        $order->address = "Hope Center - Bab Sharqi";
        $order->track_code = $track_code;
        $order->user_id = $request->input('user_id');

        try {
            $order->save();
            foreach ($cart as $index => $item) {
                $order_product = new OrderProduct();
                $order_product->order_id = $order->id;
                $order_product->product_id = $item['productId'];
                $order_product->quantity = $item['quantity'];
                $order_product->save();
            }
            $this->cartService->clearCart();
            return redirect('/');
        } catch(Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
