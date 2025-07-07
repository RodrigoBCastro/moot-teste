<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductRepository
{
    public function search(array $filters, int $perPage = 12): LengthAwarePaginator
    {
        return Product::query()
            ->with(['category', 'brand'])
            ->when($filters['searchName'] ?? null, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->when(!empty($filters['selectedCategories']), function ($query) use ($filters) {
                $query->whereIn('category_id', $filters['selectedCategories']);
            })
            ->when(!empty($filters['selectedBrands']), function ($query) use ($filters) {
                $query->whereIn('brand_id', $filters['selectedBrands']);
            })
            ->latest()
            ->paginate($perPage);
    }

    public function create(Product $product): Product
    {
        $product->save();

        return $product;
    }
}
