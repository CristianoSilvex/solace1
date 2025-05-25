<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gray-800 rounded-lg shadow-xl overflow-hidden">
                <div class="flex flex-col md:flex-row">
                    <!-- Product Image -->
                    <div class="md:w-1/2 bg-white p-8">
                        <div class="aspect-w-1 aspect-h-1 w-full">
                            <img src="{{ asset($product->image_path) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-full object-contain bg-white">
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="md:w-1/2 p-8">
                        <h1 class="text-3xl font-bold text-white mb-4">{{ $product->name }}</h1>
                        
                        <p class="text-gray-300 mb-6">{{ $product->description }}</p>
                        
                        <div class="text-2xl font-bold text-white mb-6">
                            {{ number_format($product->price, 2, ',', '.') }} €
                        </div>

                        @if($product->is_available)
                            <form action="{{ route('cart.add') }}" method="POST" class="space-y-6">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                
                                <div>
                                    <label for="quantity" class="block text-sm font-medium text-gray-300">
                                        Quantidade
                                    </label>
                                    <select name="quantity" id="quantity" 
                                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                        @for($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>

                                <button type="submit" 
                                    class="w-full bg-indigo-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Adicionar ao Carrinho
                                </button>
                            </form>
                        @else
                            <div class="text-red-500 font-semibold">
                                Produto Indisponível
                            </div>
                        @endif

                        <!-- Product Details -->
                        <div class="mt-8 border-t border-gray-700 pt-6">
                            <h2 class="text-xl font-semibold text-white mb-4">Detalhes do Produto</h2>
                            <div class="space-y-2 text-gray-300">
                                <p><span class="font-semibold">Categoria:</span> {{ $product->category->name }}</p>
                                <p><span class="font-semibold">Stock:</span> {{ $product->stock }}</p>
                                <p><span class="font-semibold">Disponibilidade:</span> 
                                    @if($product->is_available)
                                        <span class="text-green-500">Em Stock</span>
                                    @else
                                        <span class="text-red-500">Indisponível</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 