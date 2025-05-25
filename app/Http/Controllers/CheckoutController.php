<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Services\PaymentService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;

class CheckoutController extends Controller
{
    private PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function showCheckout()
    {
        $cart = auth()->check() 
            ? Cart::where('user_id', auth()->id())->first()
            : Cart::where('session_id', session()->getId())->first();

        if (!$cart || $cart->items->isEmpty()) {
            session()->flash('notification', [
                'type' => 'error',
                'message' => 'O seu carrinho está vazio.'
            ]);
            return redirect()->route('cart.index');
        }

        return view('checkout', [
            'cart' => $cart,
            'total' => $cart->total()
        ]);
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string',
            'billing_address' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'payment_method' => 'required|in:' . implode(',', [
                Payment::METHOD_MULTIBANCO,
                Payment::METHOD_MBWAY,
                Payment::METHOD_CREDIT_CARD
            ]),
            'payment_phone' => 'required_if:payment_method,' . Payment::METHOD_MBWAY
        ]);

        try {
            DB::beginTransaction();

            $cart = auth()->check() 
                ? Cart::where('user_id', auth()->id())->first()
                : Cart::where('session_id', session()->getId())->first();

            if (!$cart || $cart->items->isEmpty()) {
                throw new Exception('O seu carrinho está vazio.');
            }

            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'status' => Order::STATUS_PENDING,
                'shipping_address' => $request->shipping_address,
                'billing_address' => $request->billing_address,
                'email' => $request->email,
                'phone' => $request->phone,
                'total_amount' => 0, // Will be calculated from items
            ]);

            // Create order items and calculate total
            $total = 0;
            foreach ($cart->items as $item) {
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'total' => $item->price * $item->quantity
                ]);
                $total += $orderItem->total;
            }

            // Update order total
            $order->total_amount = $total;
            $order->save();

            // Process payment
            $paymentData = [
                'payment_method' => $request->payment_method,
                'phone' => $request->payment_phone
            ];
            $payment = $this->paymentService->processPayment($order, $paymentData);

            // Clear cart after successful order
            $cart->items()->delete();
            $cart->delete();

            DB::commit();

            // Store order data in session
            session()->flash('order_data', [
                'order' => $order,
                'payment' => $payment,
                'instructions' => $this->getPaymentInstructions($payment)
            ]);

            session()->flash('notification', [
                'type' => 'success',
                'message' => 'Pedido criado com sucesso! Por favor, siga as instruções de pagamento.'
            ]);

            return redirect()->route('checkout.confirmation', ['order' => $order->id]);

        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('notification', [
                'type' => 'error',
                'message' => 'Erro ao processar o pedido: ' . $e->getMessage()
            ]);
            return back()->withInput();
        }
    }

    public function showConfirmation(Order $order)
    {
        if (!session()->has('order_data')) {
            session()->flash('notification', [
                'type' => 'error',
                'message' => 'Informações do pedido não encontradas.'
            ]);
            return redirect('/');
        }

        $orderData = session()->get('order_data');
        return view('checkout-confirmation', $orderData);
    }

    private function getPaymentInstructions(Payment $payment): string
    {
        switch ($payment->payment_method) {
            case Payment::METHOD_MULTIBANCO:
                return "Para finalizar o pagamento por Multibanco, utilize os seguintes dados:\n" .
                    "Entidade: {$payment->entity}\n" .
                    "Referência: {$payment->reference}\n" .
                    "Valor: {$payment->amount}€";

            case Payment::METHOD_MBWAY:
                return "Foi enviado um pedido de pagamento para o seu telemóvel MB WAY ({$payment->phone}). " .
                    "Por favor, aceite o pagamento na aplicação MB WAY.";

            case Payment::METHOD_CREDIT_CARD:
                return "O seu pagamento por cartão de crédito está a ser processado.";

            default:
                return "A aguardar confirmação do pagamento.";
        }
    }

    public function checkStatus(Order $order)
    {
        return response()->json([
            'order_status' => $order->status,
            'payment_status' => $order->payment->status ?? null
        ]);
    }
} 