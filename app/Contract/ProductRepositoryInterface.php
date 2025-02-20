<?php

namespace App\Contract;

use App\Models\Product;

interface ProductRepositoryInterface
{
    public function getAllProducts();
    public function getProductById(Product $product);
    public function deleteProduct(Product $product);
    public function createProduct(array $attributes);
    public function updateProduct(Product $product, array $attributes);
}