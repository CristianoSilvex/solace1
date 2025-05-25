<x-guest-layout>
    <x-header />

    <!-- Hero Section with See All Button -->
    <div class="text-center mb-12 pt-24 max-w-7xl mx-auto px-4">
        <div class="mb-16">
            <img src="{{ asset('midia/solace-text-logo.png') }}" alt="Solace Collective" class="h-96 mx-auto">
        </div>
        <p class="text-2xl text-black mb-10">Descobre estilos únicos que te definem</p>
        <a href="{{ route('clothing') }}" class="inline-block px-10 py-4 bg-black text-white text-xl font-bold rounded-lg hover:bg-gray-900 transition-all transform hover:scale-105">
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
</x-guest-layout>
