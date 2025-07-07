<?php

namespace App\Livewire;

use App\Services\BrandGetAllService;
use App\Services\CategoryGetAllService;
use App\Services\ProductCreateService;
use Livewire\Component;

class ProductCreate extends Component
{
    public string $name = '';
    public float $price = 0.0;
    public int $category_id;
    public int $brand_id;

    protected ProductCreateService $productCreateService;
    protected CategoryGetAllService $categoryGetAllService;
    protected BrandGetAllService $brandGetAllService;

    public function boot(
        ProductCreateService $productCreateService,
        CategoryGetAllService $categoryGetAllService,
        BrandGetAllService $brandGetAllService
    ): void {
        $this->productCreateService = $productCreateService;
        $this->categoryGetAllService = $categoryGetAllService;
        $this->brandGetAllService = $brandGetAllService;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0.01',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
        ]);

        ($this->productCreateService)([
            'name' => $this->name,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
        ]);

        session()->flash('success', 'Produto criado com sucesso!');
        return redirect()->route('products.list');
    }

    public function render()
    {
        return view('livewire.product-create', [
            'categories' => ($this->categoryGetAllService)(),
            'brands' => ($this->brandGetAllService)(),
        ]);
    }
}
