<?php

namespace Tests\Feature\Livewire;

use App\Livewire\ProductSearch;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ProductSearchTest extends TestCase
{
    use RefreshDatabase;

    private $category1, $category2;
    private $brand1, $brand2;
    private $product1, $product2, $product3;

    protected function setUp(): void
    {
        parent::setUp();

        $this->category1 = Category::factory()->create(['name' => 'Eletrônicos']);
        $this->category2 = Category::factory()->create(['name' => 'Livros']);

        $this->brand1 = Brand::factory()->create(['name' => 'Marca A']);
        $this->brand2 = Brand::factory()->create(['name' => 'Marca B']);

        $this->product1 = Product::factory()->create([
            'name' => 'Smartphone Moderno',
            'category_id' => $this->category1->id,
            'brand_id' => $this->brand1->id,
        ]);

        $this->product2 = Product::factory()->create([
            'name' => 'Livro de Aventura',
            'category_id' => $this->category2->id,
            'brand_id' => $this->brand2->id,
        ]);

        $this->product3 = Product::factory()->create([
            'name' => 'Tablet Rápido',
            'category_id' => $this->category1->id,
            'brand_id' => $this->brand2->id,
        ]);
    }

    /** @test */
    public function component_renders_successfully_and_shows_all_products_initially()
    {
        Livewire::test(ProductSearch::class)
            ->assertStatus(200)
            ->assertSee($this->product1->name)
            ->assertSee($this->product2->name)
            ->assertSee($this->product3->name);
    }

    /** @test */
    public function it_filters_by_product_name()
    {
        Livewire::test(ProductSearch::class)
            ->set('searchName', 'Moderno')
            ->assertSee($this->product1->name)
            ->assertDontSee($this->product2->name)
            ->assertDontSee($this->product3->name);
    }

    /** @test */
    public function it_filters_by_a_single_category()
    {
        Livewire::test(ProductSearch::class)
            ->set('selectedCategories', [$this->category2->id])
            ->assertSee($this->product2->name)
            ->assertDontSee($this->product1->name)
            ->assertDontSee($this->product3->name);
    }

    /** @test */
    public function it_filters_by_multiple_brands()
    {
        Livewire::test(ProductSearch::class)
            ->set('selectedBrands', [$this->brand1->id, $this->brand2->id])
            ->assertSee($this->product1->name)
            ->assertSee($this->product2->name)
            ->assertSee($this->product3->name);
    }

    /** @test */
    public function it_filters_by_a_combination_of_name_and_category()
    {
        Livewire::test(ProductSearch::class)
            ->set('searchName', 'Tablet')
            ->set('selectedCategories', [$this->category1->id])
            ->assertSee($this->product3->name)
            ->assertDontSee($this->product1->name)
            ->assertDontSee($this->product2->name);
    }

    /** @test */
    public function clear_filters_button_resets_all_filters()
    {
        Livewire::test(ProductSearch::class)
            ->set('searchName', 'Tablet')
            ->set('selectedCategories', [$this->category1->id])
            ->assertSee($this->product3->name)
            ->assertDontSee($this->product1->name)
            ->call('clearFilters')
            ->assertSet('searchName', '')
            ->assertSet('selectedCategories', [])
            ->assertSee($this->product1->name)
            ->assertSee($this->product2->name)
            ->assertSee($this->product3->name);
    }
}
