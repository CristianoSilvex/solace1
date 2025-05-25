<header class="w-full fixed top-0 left-0 bg-white text-black py-2 px-8 shadow-[0_4px_20px_rgba(0,0,0,0.2)] z-50 flex justify-between items-center">
    <div class="flex items-center space-x-4">
        <img src="{{ asset('midia/cross-teeth-logo.png') }}" alt="Solace Collective Logo" class="h-20 w-auto">
        <h1 class="text-2xl font-semibold">Solace Collective</h1>
    </div>
    <nav>
        <ul class="flex space-x-8 items-center">
            <li><a href="/" class="hover:text-gray-600 transition-colors">Início</a></li>
            <li><a href="{{ route('clothing') }}" class="hover:text-gray-600 transition-colors">Vestuário</a></li>
            <li><a href="/about" class="hover:text-gray-600 transition-colors">Sobre Nós</a></li>
            <li><a href="{{ route('contact') }}" class="hover:text-gray-600 transition-colors">Contactos</a></li>
            <li>
                <a href="{{ route('cart.index') }}" class="text-black hover:text-gray-600 relative transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    @if(isset($cart) && $cart->items->count() > 0)
                        <span id="cart-count" class="absolute -top-2 -right-2 bg-black text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                            {{ $cart->items->count() }}
                        </span>
                    @endif
                </a>
            </li>
        </ul>
    </nav>
</header>
