<?php

namespace App\Repositories;

use App\Models\Brand;
use Illuminate\Support\Collection;

class BrandRepository
{
    public function all(): Collection
    {
        return Brand::all();
    }
}
