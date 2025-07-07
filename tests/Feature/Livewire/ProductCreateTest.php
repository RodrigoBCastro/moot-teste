<?php

namespace Tests\Feature\Livewire;

use App\Livewire\ProductCreate;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ProductCreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_renders_successfully_with_categories_and_brands()
    {
        $category1 = Category::factory()->create(['name' => 'Electronics']);
        $category2 = Category::factory()->create(['name' => 'Books']);
        $brand1 = Brand::factory()->create(['name' => 'Apple']);
        $brand2 = Brand::factory()->create(['name' => 'Samsung']);

        Livewire::test(ProductCreate::class)
            ->assertStatus(200)
            ->assertSee('Criar Novo Produto')
            ->assertSee('Nome')
            ->assertSee('Preço')
            ->assertSee('Categoria')
            ->assertSee('Marca')
            ->assertSee('Criar Produto')
            ->assertSee($category1->name)
            ->assertSee($category2->name)
            ->assertSee($brand1->name)
            ->assertSee($brand2->name);
    }

    /** @test */
    public function name_field_is_required()
    {
        Livewire::test(ProductCreate::class)
            ->set('name', '')
            ->call('save')
            ->assertHasErrors(['name' => 'required']);
    }

    /** @test */
    public function price_field_is_required_and_numeric_and_min_value()
    {
        Livewire::test(ProductCreate::class)
            ->set('price', 0)
            ->call('save')
            ->assertHasErrors(['price' => 'min']);
    }

    /** @test */
    public function category_id_is_required_and_exists()
    {
        Livewire::test(ProductCreate::class)
            ->set('category_id', '')
            ->call('save')
            ->assertHasErrors(['category_id' => 'required']);

        Livewire::test(ProductCreate::class)
            ->set('category_id', 999)
            ->call('save')
            ->assertHasErrors(['category_id' => 'exists']);
    }

    /** @test */
    public function brand_id_is_required_and_exists()
    {
        Livewire::test(ProductCreate::class)
            ->set('brand_id', '')
            ->call('save')
            ->assertHasErrors(['brand_id' => 'required']);

        Livewire::test(ProductCreate::class)
            ->set('brand_id', 999)
            ->call('save')
            ->assertHasErrors(['brand_id' => 'exists']);
    }

    /** @test */
    public function a_product_can_be_created_successfully()
    {
        $category = Category::factory()->create();
        $brand = Brand::factory()->create();

        Livewire::test(ProductCreate::class)
            ->set('name', 'New Test Product')
            ->set('price', 19.99)
            ->set('category_id', $category->id)
            ->set('brand_id', $brand->id)
            ->call('save')
            ->assertHasNoErrors()
            ->assertSessionHas('success', 'Produto criado com sucesso!')
            ->assertRedirect(route('products.list'));

        $this->assertDatabaseHas('products', [
            'name' => 'New Test Product',
            'price' => 19.99,
            'category_id' => $category->id,
            'brand_id' => $brand->id,
        ]);
    }
}
