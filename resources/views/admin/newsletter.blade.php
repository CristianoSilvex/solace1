<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Newsletter Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Send Newsletter Form -->
            <div class="bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-medium text-white mb-4">Enviar Newsletter</h3>
                
                @if (session('success'))
                    <div class="bg-gray-800 text-white p-4 rounded-lg mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('admin.newsletter.send') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="subject" class="block text-sm font-medium text-white">Assunto</label>
                        <input type="text" name="subject" id="subject" required 
                               class="mt-1 block w-full rounded-md bg-gray-800 border-gray-700 text-white shadow-sm focus:border-white focus:ring-white">
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-medium text-white">Conteúdo</label>
                        <textarea name="content" id="content" rows="6" required 
                                  class="mt-1 block w-full rounded-md bg-gray-800 border-gray-700 text-white shadow-sm focus:border-white focus:ring-white"></textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" 
                                class="bg-black text-white px-4 py-2 rounded-lg border border-white hover:bg-gray-900 transition-colors">
                            Enviar Newsletter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Subscribers List -->
            <div class="bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-white mb-4">Subscritores</h3>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-800">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                    Email
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                    Data de Subscrição
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800">
                            @foreach ($subscribers as $subscriber)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                                        {{ $subscriber->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $subscriber->is_active ? 'bg-gray-800 text-white' : 'bg-gray-700 text-gray-300' }}">
                                            {{ $subscriber->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                                        {{ $subscriber->created_at->format('d/m/Y H:i') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 