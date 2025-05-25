<x-guest-layout>
    <x-header />

    <div class="bg-white min-h-screen pt-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            @if(session('notification'))
                <x-notification 
                    :type="session('notification')['type']"
                    :message="session('notification')['message']"
                />
            @endif

            <h1 class="text-4xl font-bold text-black mb-8">Shopping Cart</h1>

            @if($cart->items->count() > 0)
                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- Cart Items -->
                    <div class="lg:w-2/3">
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                            <div class="divide-y divide-gray-200">
                                @foreach($cart->items as $item)
                                    <div class="p-6 flex items-center space-x-6" id="cart-item-{{ $item->id }}">
                                        <!-- Product Image -->
                                        <div class="flex-shrink-0 w-32 h-32 bg-white rounded-lg overflow-hidden">
                                            <img src="{{ asset($item->product->image_path) }}" 
                                                 alt="{{ $item->product->name }}" 
                                                 class="w-full h-full object-contain">
                                        </div>

                                        <!-- Product Info -->
                                        <div class="flex-1 min-w-0">
                                            <h3 class="text-xl font-semibold text-black truncate">{{ $item->product->name }}</h3>
                                            <p class="mt-1 text-gray-500">{{ number_format($item->price, 2, ',', '.') }}€</p>
                                        </div>

                                        <!-- Quantity Controls -->
                                        <div class="flex items-center space-x-4">
                                            <button type="button"
                                                    onclick="event.preventDefault(); event.stopPropagation(); updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})"
                                                    class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-gray-200 transition-colors focus:outline-none focus:ring-2 focus:ring-black {{ $item->quantity <= 1 ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer' }}"
                                                    {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                                <span class="sr-only">Decrease quantity</span>
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                                </svg>
                                            </button>
                                            
                                            <span class="text-lg font-medium text-black min-w-[2rem] text-center" id="quantity-{{ $item->id }}">
                                                {{ $item->quantity }}
                                            </span>
                                            
                                            <button type="button"
                                                    onclick="event.preventDefault(); event.stopPropagation(); updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})"
                                                    class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-gray-200 transition-colors focus:outline-none focus:ring-2 focus:ring-black cursor-pointer">
                                                <span class="sr-only">Increase quantity</span>
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                </svg>
                                            </button>
                                        </div>

                                        <!-- Subtotal -->
                                        <div class="text-right">
                                            <p class="text-lg font-semibold text-black" id="subtotal-{{ $item->id }}">
                                                {{ number_format($item->subtotal(), 2, ',', '.') }}€
                                            </p>
                                        </div>

                                        <!-- Remove Button -->
                                        <button onclick="showConfirmationModal({{ $item->id }})" 
                                                class="ml-4 text-gray-400 hover:text-red-500 transition-colors">
                                            <span class="sr-only">Remove item</span>
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="lg:w-1/3">
                        <div class="bg-white rounded-xl shadow-lg p-6 sticky top-24">
                            <h2 class="text-2xl font-semibold text-black mb-6">Order Summary</h2>
                            
                            <div class="space-y-4">
                                <div class="flex justify-between text-gray-600">
                                    <span>Subtotal</span>
                                    <span id="cart-subtotal">{{ number_format($cart->total(), 2, ',', '.') }}€</span>
                                </div>
                                <div class="flex justify-between text-gray-600">
                                    <span>Shipping</span>
                                    <span>Free</span>
                                </div>
                                <div class="border-t border-gray-200 pt-4">
                                    <div class="flex justify-between text-xl font-semibold text-black">
                                        <span>Total</span>
                                        <span id="cart-total">{{ number_format($cart->total(), 2, ',', '.') }}€</span>
                                    </div>
                                </div>
                            </div>

                            @auth
                                <a href="{{ route('checkout.show') }}" 
                                   class="block w-full mt-8 bg-black text-white py-4 rounded-lg font-bold text-lg hover:bg-gray-900 transition-colors transform hover:scale-105 text-center">
                                    Finalizar Compra
                                </a>
                            @else
                                <div class="space-y-4 mt-8">
                                    <a href="{{ route('login') }}" 
                                       class="block w-full bg-black text-white py-4 rounded-lg font-bold text-lg hover:bg-gray-900 transition-colors transform hover:scale-105 text-center">
                                        Iniciar Sessão
                                    </a>
                                    <div class="text-center text-gray-600">ou</div>
                                    <a href="{{ route('register') }}" 
                                       class="block w-full bg-gray-800 text-white py-4 rounded-lg font-bold text-lg hover:bg-gray-700 transition-colors transform hover:scale-105 text-center">
                                        Criar Conta
                                    </a>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-16 bg-white rounded-xl shadow-lg">
                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <h2 class="mt-4 text-2xl font-semibold text-black">Your cart is empty</h2>
                    <p class="mt-2 text-gray-500">Looks like you haven't added any items yet.</p>
                    <a href="{{ route('clothing') }}" 
                       class="inline-block mt-8 px-8 py-3 bg-black text-white font-bold rounded-lg hover:bg-gray-900 transition-all transform hover:scale-105">
                        Continue Shopping
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmationModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-6 max-w-sm w-full mx-4">
            <h3 class="text-xl font-semibold text-black mb-4">Confirm Removal</h3>
            <p class="text-gray-600 mb-6">Are you sure you want to remove this item from your cart?</p>
            <div class="flex justify-end space-x-4">
                <button onclick="closeConfirmationModal()" 
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors">
                    Cancel
                </button>
                <button id="confirmRemoveButton"
                        class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                    Remove
                </button>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    console.log('Cart script loaded');

    let isUpdating = false;
    let updateQueue = new Map();
    let itemToRemove = null;

    function showConfirmationModal(itemId) {
        itemToRemove = itemId;
        const modal = document.getElementById('confirmationModal');
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeConfirmationModal() {
        const modal = document.getElementById('confirmationModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        itemToRemove = null;
    }

    async function updateQuantity(itemId, newQuantity) {
        console.log('Updating quantity:', { itemId, newQuantity });
        
        if (newQuantity < 1) {
            console.log('Invalid quantity, must be >= 1');
            return;
        }

        // If there's already a pending update for this item, update the target quantity
        if (updateQueue.has(itemId)) {
            updateQueue.set(itemId, newQuantity);
            console.log('Update queued for item:', itemId);
            return;
        }

        // Add this update to the queue
        updateQueue.set(itemId, newQuantity);

        // If an update is in progress, wait for it to complete
        if (isUpdating) {
            console.log('Update in progress, queued for later');
            return;
        }

        // Process all queued updates
        while (updateQueue.size > 0) {
            isUpdating = true;
            const [currentItemId, targetQuantity] = Array.from(updateQueue.entries())[0];
            
            try {
                // Disable the buttons during update
                const buttons = document.querySelectorAll(`button[onclick*="updateQuantity(${currentItemId}"]`);
                buttons.forEach(btn => btn.disabled = true);

                const response = await fetch(`/cart/items/${currentItemId}/quantity`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        quantity: targetQuantity
                    })
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();
                console.log('Update response:', data);
                
                // Update the quantity display
                const quantityElement = document.getElementById(`quantity-${currentItemId}`);
                if (quantityElement) {
                    quantityElement.textContent = targetQuantity;
                }

                // Update the subtotal for this item
                const subtotalElement = document.getElementById(`subtotal-${currentItemId}`);
                if (subtotalElement) {
                    subtotalElement.textContent = data.subtotal;
                }

                // Update cart totals
                const subtotalDisplay = document.getElementById('cart-subtotal');
                const totalDisplay = document.getElementById('cart-total');
                if (subtotalDisplay) subtotalDisplay.textContent = data.total;
                if (totalDisplay) totalDisplay.textContent = data.total;

                // Update cart count in header
                const cartCount = document.getElementById('cart-count');
                if (cartCount) {
                    cartCount.textContent = data.cart_count;
                }

                // Re-enable and update button states
                buttons.forEach(btn => {
                    btn.disabled = false;
                    if (targetQuantity <= 1 && !btn.innerHTML.includes('m8-8H4')) {
                        // This is the decrease button and quantity is 1
                        btn.disabled = true;
                        btn.classList.add('opacity-50', 'cursor-not-allowed');
                    } else {
                        btn.classList.remove('opacity-50', 'cursor-not-allowed');
                    }
                });

            } catch (error) {
                console.error('Error updating quantity:', error);
                // Re-enable all buttons on error
                const buttons = document.querySelectorAll(`button[onclick*="updateQuantity(${currentItemId}"]`);
                buttons.forEach(btn => {
                    btn.disabled = false;
                    if (targetQuantity > 1 || btn.innerHTML.includes('m8-8H4')) {
                        btn.classList.remove('opacity-50', 'cursor-not-allowed');
                    }
                });
            } finally {
                // Remove the processed update from queue
                updateQueue.delete(currentItemId);
                isUpdating = false;
            }
        }
    }

    async function removeItem(itemId) {
        showConfirmationModal(itemId);
    }

    // Add event listener for the confirm button
    document.getElementById('confirmRemoveButton').addEventListener('click', async function() {
        if (!itemToRemove) return;
        
        try {
            const response = await fetch(`/cart/items/${itemToRemove}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();
            console.log('Remove response:', data);
            
            // Remove the item from DOM
            const itemElement = document.getElementById(`cart-item-${itemToRemove}`);
            if (itemElement) {
                itemElement.remove();
            }

            // Update both cart subtotal and total
            const subtotalDisplay = document.getElementById('cart-subtotal');
            const totalDisplay = document.getElementById('cart-total');
            if (subtotalDisplay) subtotalDisplay.textContent = data.total;
            if (totalDisplay) totalDisplay.textContent = data.total;

            // Update cart count in header
            const cartCount = document.getElementById('cart-count');
            if (cartCount) {
                cartCount.textContent = data.cart_count;
            }

            // If cart is empty, reload the page to show empty state
            if (data.cart_count === 0) {
                location.reload();
            }

            closeConfirmationModal();
        } catch (error) {
            console.error('Error removing item:', error);
            closeConfirmationModal();
        }
    });

    // Close modal when clicking outside
    document.getElementById('confirmationModal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeConfirmationModal();
        }
    });

    // Add event listeners for quantity buttons
    document.addEventListener('DOMContentLoaded', () => {
        console.log('Cart page initialized');
    });
    </script>
    @endpush
</x-guest-layout> 