<?php

namespace App\Livewire;

use App\Services\BrandGetAllService;
use App\Services\CategoryGetAllService;
use App\Services\ProductSearchService;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ProductSearch extends Component
{
    use WithPagination;

    #[Url(as: 'q', history: true)]
    public string $searchName = '';

    #[Url(as: 'cats', history: true, except: [])]
    public array $selectedCategories = [];

    #[Url(as: 'brands', history: true, except: [])]
    public array $selectedBrands = [];

    protected ProductSearchService $productSearch;
    protected CategoryGetAllService $categoryGetAllService;
    protected BrandGetAllService $brandGetAllService;

    public function boot(
        ProductSearchService  $productSearch,
        CategoryGetAllService $categoryGetAllService,
        BrandGetAllService $brandGetAllService
    ): void {
        $this->productSearch = $productSearch;
        $this->categoryGetAllService = $categoryGetAllService;
        $this->brandGetAllService = $brandGetAllService;
    }

    public function updating($key): void
    {
        if (in_array($key, ['searchName', 'selectedCategories', 'selectedBrands'])) {
            $this->resetPage();
        }
    }

    public function clearFilters(): void
    {
        $this->reset('searchName', 'selectedCategories', 'selectedBrands');
        $this->resetPage();
    }

    public function render()
    {
        $filters = [
            'searchName' => $this->searchName,
            'selectedCategories' => $this->selectedCategories,
            'selectedBrands' => $this->selectedBrands,
        ];

        return view('livewire.product-search', [
            'products' => ($this->productSearch)($filters),
            'allCategories' => ($this->categoryGetAllService)(),
            'allBrands' => ($this->brandGetAllService)(),
        ]);
    }
}
