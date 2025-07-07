<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Illuminate\Support\Collection;

readonly class CategoryGetAllService
{
    public function __construct(
        private CategoryRepository $categoryRepository
    ) {}

    public function __invoke(): Collection
    {
        return $this->categoryRepository->all();
    }
}
