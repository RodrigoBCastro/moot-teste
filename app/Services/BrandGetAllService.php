<?php

namespace App\Services;

use App\Repositories\BrandRepository;
use Illuminate\Support\Collection;

readonly class BrandGetAllService
{
    public function __construct(
        private BrandRepository $brandRepository
    ) {}

    public function __invoke(): Collection
    {
        return $this->brandRepository->all();
    }
}
