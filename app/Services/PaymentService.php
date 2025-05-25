<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Payment;
use Exception;

class PaymentService
{
    /**
     * Process a payment for an order
     */
    public function processPayment(Order $order, array $paymentData): Payment
    {
        // Validate payment method
        if (!in_array($paymentData['payment_method'], [
            Payment::METHOD_MULTIBANCO,
            Payment::METHOD_MBWAY,
            Payment::METHOD_CREDIT_CARD
        ])) {
            throw new Exception('Invalid payment method');
        }

        // Create payment record
        $payment = new Payment([
            'order_id' => $order->id,
            'payment_method' => $paymentData['payment_method'],
            'amount' => $order->total_amount,
            'status' => Payment::STATUS_PENDING
        ]);

        // Handle specific payment methods
        switch ($paymentData['payment_method']) {
            case Payment::METHOD_MULTIBANCO:
                $this->handleMultibancoPayment($payment);
                break;
            case Payment::METHOD_MBWAY:
                $this->handleMBWayPayment($payment, $paymentData['phone']);
                break;
            case Payment::METHOD_CREDIT_CARD:
                $this->handleCreditCardPayment($payment, $paymentData);
                break;
        }

        $payment->save();
        return $payment;
    }

    /**
     * Handle Multibanco payment
     */
    private function handleMultibancoPayment(Payment $payment): void
    {
        // Generate Multibanco reference (in real implementation, this would come from a payment provider)
        $payment->entity = '12345'; // Example entity
        $payment->reference = str_pad(rand(0, 999999999), 9, '0', STR_PAD_LEFT);
    }

    /**
     * Handle MB WAY payment
     */
    private function handleMBWayPayment(Payment $payment, string $phone): void
    {
        // Validate phone number format (Portuguese format)
        if (!preg_match('/^9[1236][0-9]{7}$/', $phone)) {
            throw new Exception('Invalid phone number format for MB WAY');
        }

        $payment->phone = $phone;
        // In a real implementation, this would integrate with MB WAY API
    }

    /**
     * Handle credit card payment
     */
    private function handleCreditCardPayment(Payment $payment, array $paymentData): void
    {
        // In a real implementation, this would integrate with a payment gateway
        // For now, we'll just mark it as pending
        $payment->status = Payment::STATUS_PENDING;
    }

    /**
     * Check payment status
     */
    public function checkPaymentStatus(Payment $payment): string
    {
        // In a real implementation, this would check with the payment provider
        // For now, we'll just return the current status
        return $payment->status;
    }

    /**
     * Update payment status
     */
    public function updatePaymentStatus(Payment $payment, string $status): void
    {
        if (!in_array($status, [
            Payment::STATUS_PENDING,
            Payment::STATUS_COMPLETED,
            Payment::STATUS_FAILED
        ])) {
            throw new Exception('Invalid payment status');
        }

        $payment->status = $status;
        $payment->save();

        if ($status === Payment::STATUS_COMPLETED) {
            $payment->order->status = Order::STATUS_PAID;
            $payment->order->save();
        }
    }
} 