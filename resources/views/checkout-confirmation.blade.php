<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Confirmação de Compra') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-2xl mx-auto p-6">
                    @if(session('notification'))
                        <x-notification 
                            :type="session('notification')['type']"
                            :message="session('notification')['message']"
                        />
                    @endif

                    <div class="text-center mb-8">
                        <h1 class="text-3xl font-bold text-green-600 mb-2">Pedido Confirmado</h1>
                        <p class="text-gray-600">O seu pedido foi registado com sucesso.</p>
                    </div>

                    <div class="border-t border-b py-4 my-4">
                        <h2 class="text-xl font-semibold mb-4">Instruções de Pagamento</h2>
                        <div class="bg-gray-50 p-4 rounded">
                            {!! nl2br(e($instructions)) !!}
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <h3 class="font-medium">Número do Pedido</h3>
                            <p class="text-gray-600">{{ $order->id }}</p>
                        </div>

                        <div>
                            <h3 class="font-medium">Total</h3>
                            <p class="text-gray-600">{{ number_format($order->total_amount, 2) }}€</p>
                        </div>

                        <div>
                            <h3 class="font-medium">Morada de Envio</h3>
                            <p class="text-gray-600">{{ $order->shipping_address }}</p>
                        </div>
                    </div>

                    <div class="mt-8 text-center">
                        <a href="/" 
                            class="inline-block bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Voltar à Página Inicial
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 