<?php

namespace App\Services;

use App\Assembler\ProductDataToProductAssembler;
use App\Repositories\ProductRepository;

readonly class ProductCreateService
{
    public function __construct(
        private ProductRepository $productRepository,
    ) {}

    public function __invoke(array $data): void
    {
        $product = (new ProductDataToProductAssembler)($data);

        $this->productRepository->create($product);
    }
}
