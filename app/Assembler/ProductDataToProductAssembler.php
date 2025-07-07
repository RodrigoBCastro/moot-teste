<?php

namespace App\Assembler;

use App\Models\Product;

class ProductDataToProductAssembler
{
    public function __invoke(array $data): Product
    {
        $product = new Product();
        $product->name = $data['name'];
        $product->price = $data['price'];
        $product->category_id = $data['category_id'];
        $product->brand_id = $data['brand_id'];

        return $product;
    }
}
