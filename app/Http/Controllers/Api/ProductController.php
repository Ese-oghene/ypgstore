<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\Product\ProductService;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;

/**
 * @group Product Management
 * @groupDescription Handles operations related to products, such as creation, listing, updating, and deletion.
 */
class ProductController extends Controller
{

      protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

     /**
     * List Products
     *
     * Returns a list of all products
     */
    public function index(): JsonResponse
    {
        return $this->productService->getAllProduct()->toJson();
    }


    /**
     * Show Product
     *
     * Returns details of a product by ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return $this->productService->getProductById($id)->toJson();
    }



     /**
     * Create Product
     *
     * Creates a new product entry in the system.
     */
    public function store(ProductRequest $request): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('product_image')) {
            $imagePath = base64_encode(file_get_contents($request->file('product_image')->getRealPath()));
            $data['product_image'] = $imagePath;
        }

        return $this->productService->createProduct($data)->toJson();
    }


    /**Prd
     * Update Product
     *
     * Updates an existing product by ID.
     *
     * @param UpdateProductRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateProductRequest $request, int $id): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('product_image')) {
            $data['product_image'] = $request->file('product_image');
        }

        return $this->productService->updateProduct($id, $data)->toJson();
    }

    /**
     * Delete Product
     *
     * Deletes a product by ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        return $this->productService->deleteProduct($id)->toJson();
    }



}
