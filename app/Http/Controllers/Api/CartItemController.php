<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\CartItem\CartItemService;
use App\Http\Requests\CartItem\AddToCartRequest;
use App\Http\Requests\CartItem\UpdateCartQuantityRequest;


/**
 * @group Cart Management
 * @groupDescription Handles operations related to user's shopping cart such as adding, updating, retrieving, and removing items.
 */
class CartItemController extends Controller
{
  protected CartItemService $cartItemService;

  public function __construct(CartItemService $cartItemService)
    {
        $this->cartItemService = $cartItemService;
    }


    /**
     * Get My Cart
     *
     * Retrieve all cart items for the authenticated user.
     */

       public function index(): JsonResponse
    {
        return $this->cartItemService->getMyCart(auth()->id())->toJson();
    }

    /**
     * Add to Cart
     *
     * Add a product to the cart.
     */
     public function store(AddToCartRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        return $this->cartItemService->addToCart($data)->toJson();
    }

    /**
     * Update Quantity
     *
     * Change quantity of a specific cart item.
     */
     public function update(UpdateCartQuantityRequest $request, int $cartItemId): JsonResponse
    {
        $data = $request->validated();

        return $this->cartItemService->changeQuantity($cartItemId, $data['quantity'])->toJson();
    }

    /**
     * Remove Item from Cart
     *
     * Delete a specific item from the cart.
     */
    public function destroy(int $cartItemId): JsonResponse
    {
        return $this->cartItemService->removeFromCart($cartItemId)->toJson();
    }

     /**
     * Empty Cart
     *
     * Clear all items in the authenticated user's cart.
     */
    public function empty(): JsonResponse
    {
        return $this->cartItemService->emptyCart(auth()->id())->toJson();
    }


}
