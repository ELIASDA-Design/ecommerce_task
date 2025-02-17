<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class CartService
{
    protected $cartKey = 'shopping_cart';

    public function addItem($productId, $quantity, $price,$name)
    {
        $cart = Session::get($this->cartKey, []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'quantity' => $quantity,
                'price' => $price,
                'name' => $name,
                'productId' => $productId
            ];
        }

        Session::put($this->cartKey, $cart);
    }

    public function removeItem($productId)
    {
        $cart = Session::get($this->cartKey, []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put($this->cartKey, $cart);
        }
    }

    public function updateItem($productId, $quantity)
    {
        $cart = Session::get($this->cartKey, []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            Session::put($this->cartKey, $cart);
        }
    }

    public function getCart()
    {
        return Session::get($this->cartKey, []);
    }

    public function clearCart()
    {
        Session::forget($this->cartKey);
    }

    public function getTotal()
    {
        $cart = $this->getCart();
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['quantity'] * $item['price'];
        }

        return $total;
    }
}
