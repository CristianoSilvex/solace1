@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 py-12">
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
                        <form action="{{ route('cart.add') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            
                            <div class="flex items-center space-x-4">
                                <label for="quantity" class="text-white">Quantidade:</label>
                                <div class="flex items-center space-x-2">
                                    <button type="button" 
                                            onclick="decrementQuantity()"
                                            class="h-8 w-8 rounded-full bg-gray-700 text-white hover:bg-gray-600">-</button>
                                    <input type="number" 
                                           id="quantity" 
                                           name="quantity" 
                                           value="1" 
                                           min="1" 
                                           class="w-16 rounded bg-gray-700 px-2 py-1 text-center text-white"
                                           readonly>
                                    <button type="button" 
                                            onclick="incrementQuantity()"
                                            class="h-8 w-8 rounded-full bg-gray-700 text-white hover:bg-gray-600">+</button>
                                </div>
                            </div>

                            <button type="submit" 
                                    class="w-full rounded-lg bg-white px-6 py-3 font-bold text-black transition-all hover:bg-gray-100 hover:scale-105">
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

@push('scripts')
<script>
    function incrementQuantity() {
        const input = document.getElementById('quantity');
        input.value = parseInt(input.value) + 1;
    }

    function decrementQuantity() {
        const input = document.getElementById('quantity');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }
</script>
@endpush
@endsection 