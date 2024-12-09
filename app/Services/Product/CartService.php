<?php

namespace App\Services\Product;

use App\Models\Cart;
use App\Models\Product;
use App\Interfaces\SessionKeyInterface;

class CartService implements SessionKeyInterface
{
    /**
     * Summary of addToCart
     * @param \App\Http\Requests\CartRequest $item
     * @throws \Exception
     * @return array
     */
    public function addToCart($item)
    {
        /**
         * @var \App\Models\User $user
         */
        $user = session(self::SESSION_IDENTITY);

        $product = Product::where('product_serial_code', $item['product_serial'])->first();

        if (!$product) {
            throw new \Exception('Invalid operation.');
        }

        $currentStock = $product->stocks;
        if (!$this->isAvailable($currentStock, $item['quantity'])) {
            throw new \Exception('Invalid operation.');
        }

        $cart = new Cart();
        $cart->user_id = $user->id;
        $cart->product_id = $product->id;
        $cart->quantity = $item['quantity'];
        $cart->save();

        return [$product, $item['quantity']];
    }

    /**
     * Summary of updateStocks
     * @param \App\Models\Product $product
     * @param int $quantity
     * @throws \Exception
     * @return void
     */
    public function updateStocks($product, $quantity)
    {
        $currentStock = $product->stocks;

        if (!$this->isAvailable($currentStock, $quantity)) {
            throw new \Exception(__('message.invalid'));
        }

        $updatedStock = $currentStock - $quantity;
        $product->stocks = $updatedStock;
        $product->save();
    }

    /**
     * Summary of isAvailable
     * @param int $currentStock
     * @param int $quantity
     * @return bool
     */
    public function isAvailable($currentStock, $quantity)
    {
        if ($currentStock < $quantity) {
            return false;
        }

        return true;
    }
}