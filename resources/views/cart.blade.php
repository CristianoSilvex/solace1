@if(count($cart) > 0)
    <div class="mt-8 flex justify-end">
        <a href="{{ route('checkout.show') }}" 
            class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            Finalizar Compra
        </a>
    </div>
@endif 