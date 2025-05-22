<!-- Product Modal -->
<div x-data="productModal" 
     x-show="open" 
     x-cloak
     class="fixed inset-0 z-50 overflow-y-auto"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">
    
    <!-- Toast Notification -->
    <div x-show="showToast" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform translate-y-2"
         class="fixed top-4 right-4 bg-white text-black px-6 py-3 rounded-lg shadow-lg z-50">
        <p x-text="toastMessage"></p>
    </div>

    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black bg-opacity-75"></div>

    <!-- Modal Content -->
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="relative bg-gray-900 rounded-lg max-w-4xl w-full overflow-hidden">
            <!-- Close button -->
            <button @click="open = false" class="absolute right-4 top-4 text-gray-400 hover:text-white">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <div class="flex flex-col md:flex-row">
                <!-- Product image -->
                <div class="md:w-1/2 bg-white">
                    <img :src="product && product.image_path" :alt="product && product.name" class="h-96 w-full object-contain md:h-full">
                </div>

                <!-- Product details -->
                <div class="space-y-4 p-6 md:w-1/2">
                    <h3 x-text="product && product.name" class="text-2xl font-bold text-white"></h3>
                    <p x-text="product && product.description" class="text-gray-300"></p>
                    <p class="text-xl font-bold text-white">
                        <span x-text="product && new Intl.NumberFormat('pt-PT', { style: 'currency', currency: 'EUR' }).format(product.price)"></span>
                    </p>
                    
                    <!-- Add to cart form -->
                    <form @submit.prevent="addToCart" class="mt-6 space-y-4">
                        <div class="flex items-center space-x-4">
                            <label for="quantity" class="text-white">Quantidade:</label>
                            <div class="flex items-center space-x-2">
                                <button type="button" 
                                        @click="quantity > 1 ? quantity-- : null"
                                        class="h-8 w-8 rounded-full bg-gray-800 text-white hover:bg-gray-700">-</button>
                                <input type="number" 
                                       x-model="quantity" 
                                       min="1" 
                                       class="w-16 rounded bg-gray-800 px-2 py-1 text-center text-white"
                                       readonly>
                                <button type="button" 
                                        @click="quantity++"
                                        class="h-8 w-8 rounded-full bg-gray-800 text-white hover:bg-gray-700">+</button>
                            </div>
                        </div>
                        
                        <button type="submit" 
                                class="w-full rounded-lg bg-white px-4 py-2 font-bold text-black transition-all hover:bg-gray-100 hover:scale-105">
                            Adicionar ao Carrinho
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('productModal', () => ({
            open: false,
            product: null,
            quantity: 1,
            showToast: false,
            toastMessage: '',
            
            async addToCart() {
                if (!this.product) return;
                
                try {
                    const response = await fetch('/cart/add', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            product_id: this.product.id,
                            quantity: this.quantity
                        })
                    });
                    
                    const data = await response.json();
                    
                    // Update cart count
                    const cartCount = document.getElementById('cart-count');
                    if (cartCount) {
                        cartCount.textContent = data.cart_count;
                    }
                    
                    // Close modal
                    this.open = false;
                    this.quantity = 1;
                    
                    // Show success message
                    this.toastMessage = 'Produto adicionado ao carrinho';
                    this.showToast = true;
                    setTimeout(() => {
                        this.showToast = false;
                    }, 3000);
                } catch (error) {
                    console.error('Erro ao adicionar ao carrinho:', error);
                    this.toastMessage = 'Erro ao adicionar ao carrinho';
                    this.showToast = true;
                    setTimeout(() => {
                        this.showToast = false;
                    }, 3000);
                }
            }
        }));
    });
</script>
@endpush 