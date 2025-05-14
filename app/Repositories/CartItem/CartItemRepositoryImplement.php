<?php

namespace App\Repositories\CartItem;

use App\Models\CartItem;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Implementations\Eloquent;

class CartItemRepositoryImplement extends Eloquent implements CartItemRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected CartItem $model;

    public function __construct(CartItem $model)
    {
        $this->model = $model;
    }


    public function addItem(array $data)
    {
        return CartItem::create($data);
    }

    public function getUserCart(int $userId)
    {
        return CartItem::with('product')->where('user_id', $userId)->get();
    }

    public function updateItemQuantity(int $cartItemId, int $quantity)
    {
        return CartItem::where('id', $cartItemId)->update(['quantity' => $quantity]);
    }

    public function removeItem(int $cartItemId)
    {
        return CartItem::destroy($cartItemId);
    }

    public function clearCart(int $userId)
    {
        return CartItem::where('user_id', $userId)->delete();
    }


    // Write something awesome :)
}
