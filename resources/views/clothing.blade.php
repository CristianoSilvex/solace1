<x-guest-layout>
    <x-header />

    <div class="min-h-screen pt-24 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <!-- Hero Section -->
            <div class="text-center mb-12">
                <h1 class="text-5xl font-extrabold mb-4 text-black tracking-wide">Toda a Roupa</h1>
                <p class="text-xl text-black mb-8">Explora a nossa coleção completa de estilos únicos</p>
            </div>

            <!-- Filters Section -->
            <div class="mb-8">
                <form action="{{ route('clothing') }}" method="GET" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Style Filter -->
                        <div>
                            <label for="style" class="block text-sm font-medium text-black mb-2">Estilo</label>
                            <select name="style" id="style" class="w-full rounded-lg bg-gray-100 border-0 text-black focus:ring-2 focus:ring-black">
                                <option value="all">Todos os Estilos</option>
                                <option value="grunge" {{ request('style') == 'grunge' ? 'selected' : '' }}>Grunge</option>
                                <option value="opium" {{ request('style') == 'opium' ? 'selected' : '' }}>Opium</option>
                                <option value="streetwear" {{ request('style') == 'streetwear' ? 'selected' : '' }}>Streetwear</option>
                                <option value="usa_drip" {{ request('style') == 'usa_drip' ? 'selected' : '' }}>USA Drip</option>
                            </select>
                        </div>

                        <!-- Type Filter -->
                        <div>
                            <label for="type" class="block text-sm font-medium text-black mb-2">Tipo</label>
                            <select name="type" id="type" class="w-full rounded-lg bg-gray-100 border-0 text-black focus:ring-2 focus:ring-black">
                                <option value="all">Todos os Tipos</option>
                                <option value="tops" {{ request('type') == 'tops' ? 'selected' : '' }}>Tops</option>
                                <option value="bottoms" {{ request('type') == 'bottoms' ? 'selected' : '' }}>Bottoms</option>
                                <option value="outerwear" {{ request('type') == 'outerwear' ? 'selected' : '' }}>Outerwear</option>
                                <option value="footwear" {{ request('type') == 'footwear' ? 'selected' : '' }}>Footwear</option>
                                <option value="hats" {{ request('type') == 'hats' ? 'selected' : '' }}>Hats</option>
                            </select>
                        </div>

                        <!-- Search Filter -->
                        <div>
                            <label for="search" class="block text-sm font-medium text-black mb-2">Procurar</label>
                            <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                   class="w-full rounded-lg bg-gray-100 border-0 text-black focus:ring-2 focus:ring-black" 
                                   placeholder="Procurar produtos...">
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-8 py-3 bg-black text-white font-bold rounded-lg hover:bg-gray-900 transition-all transform hover:scale-105">
                            Filtrar
                        </button>
                    </div>
                </form>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse ($products as $product)
                    <div class="group relative cursor-pointer transform transition-all duration-300 hover:scale-105"
                         onclick="openProductModal({{ json_encode($product) }})">
                        <!-- Product Card -->
                        <div class="w-full h-[300px] bg-white rounded-xl overflow-hidden shadow-md
                                  transition-all duration-300
                                  hover:shadow-[0_10px_40px_rgba(0,0,0,0.15)]
                                  active:shadow-[0_5px_20px_rgba(0,0,0,0.1)]">
                            <div class="w-full h-full flex items-center justify-center p-4">
                                <img src="{{ asset($product->image_path) }}" 
                                     alt="{{ $product->name }}" 
                                     class="max-w-full max-h-full object-contain transition-transform duration-300 group-hover:scale-105">
                            </div>
                        </div>
                        <!-- Product Info -->
                        <div class="text-center mt-4 transform transition-all duration-300 group-hover:translate-y-1">
                            <h3 class="text-xl text-black font-semibold">{{ $product->name }}</h3>
                            <p class="text-lg font-semibold text-black mt-1">{{ number_format($product->price, 2, ',', '.') }}€</p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <h3 class="text-2xl text-black font-semibold">Nenhum produto encontrado</h3>
                        <p class="text-gray-600 mt-2">Tente selecionar uma categoria diferente</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-16 pb-12">
                <div class="pagination-container">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Include the product modal component -->
    <x-product-modal />

    @push('styles')
    <style>
        [x-cloak] { 
            display: none !important; 
        }
        .pagination-container nav {
            display: flex;
            justify-content: center;
        }
        .pagination-container nav > div {
            display: flex;
            gap: 1rem;
        }
        .pagination-container nav > div > div,
        .pagination-container nav > div > a {
            padding: 0.5rem 1rem;
            background-color: black;
            color: white;
            border-radius: 0.5rem;
            transition: all 0.2s;
        }
        .pagination-container nav > div > div:hover,
        .pagination-container nav > div > a:hover {
            background-color: #333;
            transform: scale(1.05);
        }
        .pagination-container nav > div > span {
            padding: 0.5rem 1rem;
            background-color: white;
            color: black;
            border-radius: 0.5rem;
        }
    </style>
    @endpush

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        console.log('Page loaded');
        if (typeof openProductModal === 'undefined') {
            console.error('openProductModal is not defined!');
        } else {
            console.log('openProductModal is available');
        }
    });
    </script>
    @endpush
</x-guest-layout> 