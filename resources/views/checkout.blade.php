<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if(session('notification'))
                    <x-notification 
                        :type="session('notification')['type']"
                        :message="session('notification')['message']"
                    />
                @endif

                @if($errors->any())
                    <x-notification 
                        type="error"
                        :message="$errors->first()"
                    />
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Order Summary -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h2 class="text-xl font-semibold mb-4">Resumo do Pedido</h2>
                        <div class="space-y-4">
                            @foreach($cart->items as $item)
                                <div class="flex justify-between items-center border-b pb-2">
                                    <div>
                                        <h3 class="font-medium">{{ $item->product->name }}</h3>
                                        <p class="text-sm text-gray-600">Quantidade: {{ $item->quantity }}</p>
                                    </div>
                                    <p class="font-medium">{{ number_format($item->price * $item->quantity, 2) }}€</p>
                                </div>
                            @endforeach
                            <div class="flex justify-between items-center pt-2 font-bold">
                                <p>Total</p>
                                <p>{{ number_format($total, 2) }}€</p>
                            </div>
                        </div>
                    </div>

                    <!-- Checkout Form -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h2 class="text-xl font-semibold mb-4">Dados de Envio e Pagamento</h2>
                        <form action="{{ route('checkout.process') }}" method="POST" class="space-y-4">
                            @csrf

                            <!-- Shipping Address -->
                            <div>
                                <label for="shipping_address" class="block text-sm font-medium text-gray-700">Morada de Envio</label>
                                <textarea name="shipping_address" id="shipping_address" rows="3" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    required>{{ old('shipping_address') }}</textarea>
                            </div>

                            <!-- Billing Address -->
                            <div>
                                <label for="billing_address" class="block text-sm font-medium text-gray-700">Morada de Faturação</label>
                                <textarea name="billing_address" id="billing_address" rows="3" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    required>{{ old('billing_address') }}</textarea>
                            </div>

                            <!-- Contact Info -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                    <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                </div>
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Telemóvel</label>
                                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                </div>
                            </div>

                            <!-- Payment Method -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Método de Pagamento</label>
                                <div class="space-y-2">
                                    <label class="flex items-center">
                                        <input type="radio" name="payment_method" value="multibanco" 
                                            class="form-radio h-4 w-4 text-indigo-600" required>
                                        <span class="ml-2">Multibanco</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="payment_method" value="mbway" 
                                            class="form-radio h-4 w-4 text-indigo-600">
                                        <span class="ml-2">MB WAY</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="payment_method" value="credit_card" 
                                            class="form-radio h-4 w-4 text-indigo-600">
                                        <span class="ml-2">Cartão de Crédito</span>
                                    </label>
                                </div>
                            </div>

                            <!-- MB WAY Phone -->
                            <div id="mbway-phone-field" class="hidden">
                                <label for="payment_phone" class="block text-sm font-medium text-gray-700">Telemóvel MB WAY</label>
                                <input type="tel" name="payment_phone" id="payment_phone" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <p class="mt-1 text-sm text-gray-500">Formato: 9xxxxxxxx</p>
                            </div>

                            <button type="submit" 
                                class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Finalizar Compra
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paymentMethodInputs = document.querySelectorAll('input[name="payment_method"]');
            const mbwayPhoneField = document.getElementById('mbway-phone-field');

            paymentMethodInputs.forEach(input => {
                input.addEventListener('change', function() {
                    if (this.value === 'mbway') {
                        mbwayPhoneField.classList.remove('hidden');
                        document.getElementById('payment_phone').required = true;
                    } else {
                        mbwayPhoneField.classList.add('hidden');
                        document.getElementById('payment_phone').required = false;
                    }
                });
            });
        });
    </script>
    @endpush
</x-app-layout> 