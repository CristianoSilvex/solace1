<x-guest-layout>
    <x-header />

    <div class="bg-black min-h-screen pt-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-3xl font-bold text-white mb-8">Carrinho de Compras</h1>

            @if($cart->items->count() > 0)
                <div class="bg-gray-900 rounded-lg overflow-hidden">
                    <!-- Cart Items -->
                    <div class="divide-y divide-gray-700">
                        @foreach($cart->items as $item)
                            <div class="p-6 flex items-center space-x-6" id="cart-item-{{ $item->id }}">
                                <!-- Product Image -->
                                <div class="flex-shrink-0 w-24 h-24">
                                    <img src="{{ asset($item->product->image_path) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover rounded-md">
                                </div>

                                <!-- Product Info -->
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-white">{{ $item->product->name }}</h3>
                                    <p class="text-gray-400">{{ number_format($item->price, 2, ',', '.') }}€</p>
                                </div>

                                <!-- Quantity Controls -->
                                <div class="flex items-center space-x-4">
                                    <button onclick="updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})" 
                                            class="text-white bg-gray-800 rounded-full w-8 h-8 flex items-center justify-center hover:bg-white hover:text-black transition-colors"
                                            {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                        -
                                    </button>
                                    <span class="text-white" id="quantity-{{ $item->id }}">{{ $item->quantity }}</span>
                                    <button onclick="updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})" 
                                            class="text-white bg-gray-800 rounded-full w-8 h-8 flex items-center justify-center hover:bg-white hover:text-black transition-colors">
                                        +
                                    </button>
                                </div>

                                <!-- Subtotal -->
                                <div class="text-right">
                                    <p class="text-lg font-semibold text-white" id="subtotal-{{ $item->id }}">
                                        {{ number_format($item->subtotal(), 2, ',', '.') }}€
                                    </p>
                                </div>

                                <!-- Remove Button -->
                                <button onclick="removeItem({{ $item->id }})" 
                                        class="text-red-500 hover:text-red-600 transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <!-- Cart Total -->
                    <div class="p-6 bg-gray-800">
                        <div class="flex justify-between items-center">
                            <span class="text-lg text-white">Total</span>
                            <span class="text-2xl font-bold text-white" id="cart-total">
                                {{ number_format($cart->total(), 2, ',', '.') }}€
                            </span>
                        </div>
                        <button class="mt-4 w-full bg-white text-black py-3 rounded-lg font-bold hover:bg-gray-100 transition-all transform hover:scale-105">
                            Finalizar Compra
                        </button>
                    </div>
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-xl text-white mb-6">O seu carrinho está vazio</p>
                    <a href="{{ route('clothing') }}" class="inline-block px-8 py-3 bg-white text-black font-bold rounded-lg hover:bg-gray-100 transition-all transform hover:scale-105">
                        Continuar a Comprar
                    </a>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        function updateQuantity(itemId, newQuantity) {
            if (newQuantity < 1) return;

            fetch(`/cart/items/${itemId}/quantity`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    quantity: newQuantity
                })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById(`quantity-${itemId}`).textContent = newQuantity;
                document.getElementById(`subtotal-${itemId}`).textContent = data.subtotal;
                document.getElementById('cart-total').textContent = data.total;
                updateCartCount(data.cart_count);
            });
        }

        function removeItem(itemId) {
            fetch(`/cart/items/${itemId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                const item = document.getElementById(`cart-item-${itemId}`);
                item.remove();
                document.getElementById('cart-total').textContent = data.total;
                updateCartCount(data.cart_count);

                if (data.cart_count === 0) {
                    location.reload();
                }
            });
        }

        function updateCartCount(count) {
            const cartCount = document.getElementById('cart-count');
            if (cartCount) {
                cartCount.textContent = count;
            }
        }
    </script>
    @endpush
</x-guest-layout> 