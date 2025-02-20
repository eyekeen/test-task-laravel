<?php

namespace App\Repositories;

use App\Contract\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAllProducts() {
        return Product::with('category')->paginate(10);
    }

    public function getProductById(Product $product){
        return $product;
    }

    public function deleteProduct(Product $product){
        $product->delete();
    }

    public function createProduct(array $attributes){
        return Product::create($attributes);
    }

    public function updateProduct(Product $product, array $attributes){
        return $product->update($attributes);
    }
}