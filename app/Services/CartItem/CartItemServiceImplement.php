<?php

namespace App\Services\CartItem;

use LaravelEasyRepository\ServiceApi;
use App\Http\Resources\CartItemResource;
use App\Repositories\CartItem\CartItemRepository;

class CartItemServiceImplement extends ServiceApi implements CartItemService{

    /**
     * set title message api for CRUD
     * @param string $title
     */
     protected string $title = "Cart Item";
     /**
     * uncomment this to override the default message
     * protected string $create_message = "";
     * protected string $update_message = "";
     * protected string $delete_message = "";
     */

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
   protected CartItemRepository $cartItemRepository;

    public function __construct(CartItemRepository $cartItemRepository)
    {
      $this->cartItemRepository = $cartItemRepository;
    }

    // Define your custom methods :)

     public function addToCart(array $data): CartItemService
    {
        try {
            $cartItem = $this->cartItemRepository->addItem($data);

            return $this->setCode(201)
                ->setMessage("Item added to cart successfully")
                ->setData(new CartItemResource($cartItem));
        } catch (\Exception $e) {
            return $this->setCode(400)
                ->setMessage("Failed to add item to cart")
                ->setError($e->getMessage());
        }
    }


        public function getMyCart(int $userId): CartItemService
    {
        try {
            $items = $this->cartItemRepository->getUserCart($userId);

            return $this->setCode(200)
                ->setMessage("Cart items retrieved successfully")
                ->setData(CartItemResource::collection($items));
        } catch (\Exception $e) {
            return $this->setCode(400)
                ->setMessage("Failed to get cart items")
                ->setError($e->getMessage());
        }
    }

     public function changeQuantity(int $cartItemId, int $quantity): CartItemService
    {
        try {
            $updated = $this->cartItemRepository->updateItemQuantity($cartItemId, $quantity);

            if (!$updated) {
                return $this->setCode(404)->setMessage("Cart item not found or unchanged");
            }

            return $this->setCode(200)->setMessage("Quantity updated successfully");
        } catch (\Exception $e) {
            return $this->setCode(400)
                ->setMessage("Failed to update cart quantity")
                ->setError($e->getMessage());
        }
    }

    public function removeFromCart(int $cartItemId): CartItemService
    {
        try {
            $deleted = $this->cartItemRepository->removeItem($cartItemId);

            if (!$deleted) {
                return $this->setCode(404)->setMessage("Cart item not found");
            }

            return $this->setCode(200)->setMessage("Cart item removed successfully");
        } catch (\Exception $e) {
            return $this->setCode(400)
                ->setMessage("Failed to remove cart item")
                ->setError($e->getMessage());
        }
    }

     public function emptyCart(int $userId): CartItemService
    {
        try {
            $this->cartItemRepository->clearCart($userId);

            return $this->setCode(200)->setMessage("Cart cleared successfully");
        } catch (\Exception $e) {
            return $this->setCode(400)
                ->setMessage("Failed to clear cart")
                ->setError($e->getMessage());
        }
    }


}
