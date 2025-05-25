@push('scripts')
<script>
console.log('Modal component loaded');

// Define the openProductModal function immediately
window.openProductModal = function(product) {
    console.log('Opening modal with:', product);
    
    const modal = document.getElementById('productModal');
    if (!modal) {
        console.error('Modal element not found!');
        return;
    }
    
    const content = document.getElementById('modalContent');
    if (!content) {
        console.error('Modal content element not found!');
        return;
    }
    
    // Create the content HTML
    const html = `
        <div style="display: flex; gap: 32px; flex-direction: row;">
            <div style="width: 300px; height: 300px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; background-color: #f8f8f8; border-radius: 8px; padding: 16px;">
                <img src="${product.image_path}" 
                     alt="${product.name}" 
                     style="max-width: 100%; max-height: 100%; width: auto; height: auto; object-fit: contain;">
            </div>
            <div style="flex: 1; min-width: 0;">
                <h2 style="font-size: 24px; font-weight: bold; margin-bottom: 10px;">
                    ${product.name}
                </h2>
                <p style="margin-bottom: 20px;">
                    ${product.description || ''}
                </p>
                <p style="font-size: 20px; font-weight: bold; margin-bottom: 20px;">
                    ${new Intl.NumberFormat('pt-PT', { style: 'currency', currency: 'EUR' }).format(product.price)}
                </p>
                <div style="margin-bottom: 20px;">
                    <label>Quantidade:</label>
                    <div style="display: flex; align-items: center; gap: 10px; margin-top: 5px;">
                        <button onclick="updateQuantity(-1)" style="width: 30px; height: 30px; background: black; color: white; border: none; border-radius: 50%; cursor: pointer;">-</button>
                        <input type="number" id="quantity" value="1" min="1" style="width: 60px; text-align: center; border: 1px solid #ddd;" readonly>
                        <button onclick="updateQuantity(1)" style="width: 30px; height: 30px; background: black; color: white; border: none; border-radius: 50%; cursor: pointer;">+</button>
                    </div>
                </div>
                <button onclick="addToCart(${product.id})" 
                        style="width: 100%; padding: 10px; background: black; color: white; border: none; border-radius: 4px; cursor: pointer;">
                    Adicionar ao Carrinho
                </button>
            </div>
        </div>
    `;
    
    content.innerHTML = html;
    modal.style.display = 'block';
    document.body.style.overflow = 'hidden';
}

window.closeProductModal = function() {
    const modal = document.getElementById('productModal');
    if (!modal) {
        console.error('Modal element not found!');
        return;
    }
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

window.updateQuantity = function(change) {
    const input = document.getElementById('quantity');
    if (!input) {
        console.error('Quantity input not found!');
        return;
    }
    const newValue = parseInt(input.value) + change;
    if (newValue >= 1) {
        input.value = newValue;
    }
}

window.addToCart = async function(productId) {
    const input = document.getElementById('quantity');
    if (!input) {
        console.error('Quantity input not found!');
        return;
    }
    const quantity = input.value;
    
    try {
        const response = await fetch('/cart/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: parseInt(quantity)
            })
        });
        
        const data = await response.json();
        
        // Update cart count if exists
        const cartCount = document.getElementById('cart-count');
        if (cartCount) {
            cartCount.textContent = data.cart_count;
        }
        
        closeProductModal();
    } catch (error) {
        console.error('Error adding to cart:', error);
    }
}

// Close modal when clicking outside
document.addEventListener('click', function(event) {
    const modal = document.getElementById('productModal');
    if (!modal) return;
    
    if (event.target === modal) {
        closeProductModal();
    }
});

// Debug initialization
document.addEventListener('DOMContentLoaded', function() {
    console.log('Modal script loaded');
    const modal = document.getElementById('productModal');
    if (modal) {
        console.log('Modal element found');
    } else {
        console.error('Modal element not found on page load');
    }
});
</script>
@endpush

<!-- Product Modal -->
<div id="productModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000;">
    <div style="background: white; max-width: 800px; margin: 50px auto; padding: 20px; border-radius: 8px; position: relative;">
        <button onclick="closeProductModal()" 
                style="position: absolute; right: 10px; top: 10px; background: none; border: none; font-size: 24px; cursor: pointer;">
            ×
        </button>
        
        <div id="modalContent">
            <!-- Content will be injected here -->
        </div>
    </div>
</div>

@push('styles')
<style>
[x-cloak] {
    display: none !important;
}

body {
    background-color: white !important;
}
</style>
@endpush 