<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

readonly class ProductSearchService
{
    public function __construct(
        private ProductRepository $productRepository
    ) {}

    public function __invoke(array $filters, int $perPage = 12): LengthAwarePaginator
    {
        return $this->productRepository->search($filters, $perPage);
    }
}
