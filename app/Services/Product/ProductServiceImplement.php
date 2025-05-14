<?php

namespace App\Services\Product;


use App\Repositories\Product\ProductRepository;
use App\Services\Interfaces\ProductServiceInterface;
use App\Http\Resources\ProductResource;
use LaravelEasyRepository\ServiceApi;

class ProductServiceImplement extends ServiceApi implements ProductService{

    /**
     * set title message api for CRUD
     * @param string $title
     */
     protected string $title = "";
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
    //  protected ProductRepository $mainRepository;
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
      $this->productRepository = $productRepository;
    }

    public function getAllProduct()
    {
        try {
            $products = $this->productRepository->all();

            return $this->setCode(200)
                        ->setMessage('Products retrieved successfully')
                        ->setData(ProductResource::collection($products));
        } catch (\Exception $e) {
            return $this->setCode(500)
                        ->setMessage('Failed to retrieve products')
                        ->setError($e->getMessage());
        }
    }

    public function getProductById($id)
    {
        try {
            $product = $this->productRepository->find($id);

            return $this->setCode(200)
                        ->setMessage('Product retrieved successfully')
                        ->setData(new ProductResource($product));
        } catch (\Exception $e) {
            return $this->setCode(404)
                        ->setMessage('Product not found')
                        ->setError($e->getMessage());
        }
    }

    public function createProduct(array $data)
    {
        try {
            // Handle file input
            if (isset($data['product_image']) && $data['product_image']->isValid()) {
                $data['product_image'] = base64_encode(file_get_contents($data['product_image']->getRealPath()));
            }

            $product = $this->productRepository->create($data);

            return $this->setCode(201)
                        ->setMessage('Product created successfully')
                        ->setData(new ProductResource($product));
        } catch (\Exception $e) {
            return $this->setCode(400)
                        ->setMessage('Product creation failed')
                        ->setError($e->getMessage());
        }
    }

     public function updateProduct($id, array $data)
    {
        try {
            if (isset($data['product_image']) && $data['product_image']->isValid()) {
                $data['product_image'] = base64_encode(file_get_contents($data['product_image']->getRealPath()));
            }

            $product = $this->productRepository->update($id, $data);

            return $this->setCode(200)
                        ->setMessage('Product updated successfully')
                        ->setData(new ProductResource($product));
        } catch (\Exception $e) {
            return $this->setCode(400)
                        ->setMessage('Product update failed')
                        ->setError($e->getMessage());
        }
    }

     public function deleteProduct($id)
    {
        try {
            $this->productRepository->delete($id);

            return $this->setCode(200)
                        ->setMessage('Product deleted successfully');
        } catch (\Exception $e) {
            return $this->setCode(400)
                        ->setMessage('Product deletion failed')
                        ->setError($e->getMessage());
        }
    }

}
