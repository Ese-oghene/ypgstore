<?php

namespace App\Repositories\CartItem;

use LaravelEasyRepository\Repository;

interface CartItemRepository extends Repository{

    // Write something awesome :)

    // public function addItem(array $data);
    // public function getUserCart(int $userId);
    // public function updateItemQuantity(int $cartItemId, int $quantity);
    // public function removeItem(int $cartItemId);
    // public function clearCart(int $userId);

    public function addItem(array $data);
    public function getUserCart(int $userId);
    public function updateItemQuantity(int $cartItemId, int $quantity);
    public function removeItem(int $cartItemId);
    public function clearCart(int $userId);
}
