<x-guest-layout>
    <x-header />

    <!-- Hero Section with See All Button -->
    <div class="text-center mb-12 pt-24 max-w-4xl mx-auto px-4">
        <h1 class="text-5xl font-extrabold mb-4 text-white tracking-wide">Explora as Nossas Coleções</h1>
        <p class="text-xl text-white mb-8">Descobre estilos únicos que te definem</p>
        <a href="{{ route('clothing') }}" class="inline-block px-8 py-3 bg-black text-white font-bold rounded-lg hover:bg-gray-900 transition-all transform hover:scale-105">
            Ver Toda a Roupa
        </a>
    </div>

    <!-- Categories Showcase -->
    <div class="flex flex-nowrap justify-center gap-6 overflow-x-auto px-4 pb-8 max-w-7xl mx-auto">
        <!-- Grunge -->
        <div class="group relative h-[36rem] w-72 flex-shrink-0 bg-gray-900 overflow-hidden rounded-xl cursor-pointer">
            <a href="{{ route('clothing', ['style' => 'grunge']) }}" class="block h-full">
                <img src="{{ asset('midia/grungeee.png') }}" alt="Grunge" class="w-full h-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-105">
                <div class="absolute inset-0 bg-black bg-opacity-40 transition-opacity duration-300 group-hover:bg-opacity-20"></div>
                <div class="absolute inset-0 flex justify-center items-center">
                    <h2 class="text-4xl font-bold text-white tracking-wider">Grunge</h2>
                </div>
            </a>
        </div>

        <!-- Opium -->
        <div class="group relative h-[36rem] w-72 flex-shrink-0 bg-gray-900 overflow-hidden rounded-xl cursor-pointer">
            <a href="{{ route('clothing', ['style' => 'opium']) }}" class="block h-full">
                <img src="{{ asset('midia/cartiiii.png') }}" alt="Opium" class="w-full h-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-105">
                <div class="absolute inset-0 bg-black bg-opacity-40 transition-opacity duration-300 group-hover:bg-opacity-20"></div>
                <div class="absolute inset-0 flex justify-center items-center">
                    <h2 class="text-4xl font-bold text-white tracking-wider">Opium</h2>
                </div>
            </a>
        </div>

        <!-- Streetwear -->
        <div class="group relative h-[36rem] w-72 flex-shrink-0 bg-gray-900 overflow-hidden rounded-xl cursor-pointer">
            <a href="{{ route('clothing', ['style' => 'streetwear']) }}" class="block h-full">
                <img src="{{ asset('midia/streetwearrrr.jpg') }}" alt="Streetwear" class="w-full h-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-105">
                <div class="absolute inset-0 bg-black bg-opacity-40 transition-opacity duration-300 group-hover:bg-opacity-20"></div>
                <div class="absolute inset-0 flex justify-center items-center">
                    <h2 class="text-4xl font-bold text-white tracking-wider">Streetwear</h2>
                </div>
            </a>
        </div>

        <!-- USA Drip -->
        <div class="group relative h-[36rem] w-72 flex-shrink-0 bg-gray-900 overflow-hidden rounded-xl cursor-pointer">
            <a href="{{ route('clothing', ['style' => 'usa_drip']) }}" class="block h-full">
                <img src="{{ asset('midia/usadripp.png') }}" alt="USA Drip" class="w-full h-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-105">
                <div class="absolute inset-0 bg-black bg-opacity-40 transition-opacity duration-300 group-hover:bg-opacity-20"></div>
                <div class="absolute inset-0 flex justify-center items-center">
                    <h2 class="text-4xl font-bold text-white tracking-wider">USA Drip</h2>
                </div>
            </a>
        </div>
    </div>

    <!-- Newsletter Section -->
    <div class="bg-gray-900 py-16 mt-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-bold tracking-tight text-white">Subscreva a nossa Newsletter</h2>
                <p class="mt-4 text-lg text-white">Receba as últimas novidades e ofertas exclusivas.</p>
                
                @if (session('success'))
                    <div class="mt-4 p-4 bg-green-500 text-white rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="mt-8 flex max-w-md mx-auto gap-x-4">
                    @csrf
                    <input type="email" name="email" required 
                           class="min-w-0 flex-auto rounded-lg border-0 bg-gray-800 px-3.5 py-2 text-white shadow-sm ring-1 ring-inset ring-gray-700 focus:ring-2 focus:ring-white" 
                           placeholder="Introduza o seu email">
                    <button type="submit" 
                            class="rounded-lg bg-black px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-gray-900 transition-all transform hover:scale-105">
                        Subscrever
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
