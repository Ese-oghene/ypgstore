<?php

namespace App\Services\CartItem;

use LaravelEasyRepository\BaseService;

interface CartItemService extends BaseService{

   public function addToCart(array $data);
    public function getMyCart(int $userId);
    public function changeQuantity(int $cartItemId, int $quantity);
    public function removeFromCart(int $cartItemId);
    public function emptyCart(int $userId);
}
