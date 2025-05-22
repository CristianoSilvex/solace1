@props(['active'])

<x-guest-layout>
    <x-header />

    <div class="bg-black text-white min-h-screen py-12 pt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold tracking-wide mb-4">Contacta-nos</h1>
                <p class="text-lg text-white">Estamos aqui para ajudar. Envia-nos uma mensagem.</p>
            </div>

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="mb-8 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-8 bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div class="bg-gray-900 p-8 rounded-lg shadow-lg">
                    <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        @if ($errors->any())
                            <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div>
                            <label for="name" class="block text-sm font-medium text-white">Nome</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required 
                                   class="mt-1 block w-full rounded-md bg-gray-800 border-gray-700 text-white shadow-sm focus:border-white focus:ring-white">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-white">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required 
                                   class="mt-1 block w-full rounded-md bg-gray-800 border-gray-700 text-white shadow-sm focus:border-white focus:ring-white">
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-medium text-white">Assunto</label>
                            <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required 
                                   class="mt-1 block w-full rounded-md bg-gray-800 border-gray-700 text-white shadow-sm focus:border-white focus:ring-white">
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-white">Mensagem</label>
                            <textarea name="message" id="message" rows="4" required 
                                      class="mt-1 block w-full rounded-md bg-gray-800 border-gray-700 text-white shadow-sm focus:border-white focus:ring-white">{{ old('message') }}</textarea>
                        </div>

                        <button type="submit" 
                                class="w-full bg-white text-black px-4 py-2 rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-900 transition-all transform hover:scale-105">
                            Enviar Mensagem
                        </button>
                    </form>
                </div>

                <!-- Contact Information -->
                <div class="space-y-8">
                    <div>
                        <h2 class="text-2xl font-bold mb-4 text-white">Informação de Contacto</h2>
                        <div class="space-y-4">
                            <p class="flex items-center">
                                <i class="fas fa-envelope mr-3 text-white text-4xl hover:text-gray-300 transition"></i>
                                <span class="text-white">solacecollectiveofficial@gmail.com</span>
                            </p>
                            <p class="flex items-center">
                                <i class="fab fa-instagram mr-3 text-white text-4xl hover:text-gray-300 transition"></i>
                                <span class="text-white">@solace.pt</span>
                            </p>
                        </div>
                    </div>

                    <div>
                        <h2 class="text-2xl font-bold mb-4 text-white">Horário de Atendimento</h2>
                        <p class="text-lg text-white">Segunda a Sexta: 9:00 - 18:00</p>
                        <p class="text-lg text-white">Sábado: 10:00 - 15:00</p>
                        <p class="text-lg text-white">Domingo: Fechado</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>