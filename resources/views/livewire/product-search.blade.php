<div class="container mx-auto py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold">Busca de Produtos</h1>
        <a href="{{ route('products.create') }}"
           class="px-4 py-2 bg-green-600 text-white rounded-md shadow hover:bg-green-700 transition-colors duration-200">
            Novo Produto
        </a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8 p-4 border rounded-lg bg-gray-50">
        <div>
            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Nome do Produto</label>
            <input type="text" id="search" wire:model.live.debounce.300ms="searchName" placeholder="Ex: Smartphone"
                   class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        <div>
            <h3 class="text-sm font-medium text-gray-700 mb-2">Categorias</h3>
            <div class="space-y-2 max-h-40 overflow-y-auto">
                @foreach($allCategories as $category)
                    <div class="flex items-center">
                        <input id="cat-{{ $category->id }}" type="checkbox" value="{{ $category->id }}" wire:model.live="selectedCategories"
                               class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="cat-{{ $category->id }}" class="ml-2 text-sm text-gray-600">{{ $category->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <div>
            <h3 class="text-sm font-medium text-gray-700 mb-2">Marcas</h3>
            <div class="space-y-2 max-h-40 overflow-y-auto">
                @foreach($allBrands as $brand)
                    <div class="flex items-center">
                        <input id="brand-{{ $brand->id }}" type="checkbox" value="{{ $brand->id }}" wire:model.live="selectedBrands"
                               class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="brand-{{ $brand->id }}" class="ml-2 text-sm text-gray-600">{{ $brand->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex items-end">
            <button wire:click="clearFilters" class="w-full px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                Limpar Filtros
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($products as $product)
            <div class="border rounded-lg p-4 shadow-sm flex flex-col">
                <h2 class="text-lg font-bold">{{ $product->name }}</h2>
                <div class="text-sm text-gray-500 mt-1">
                    <span>{{ $product->category->name }}</span> | <span>{{ $product->brand->name }}</span>
                </div>
                <div class="mt-auto pt-4 text-lg font-semibold text-right">
                    R$ {{ number_format($product->price, 2, ',', '.') }}
                </div>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-500 py-10">
                <p>Nenhum produto encontrado com os filtros selecionados.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $products->links() }}
    </div>
</div>
