<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Transaction;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Set Midtrans configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false; // Set true if using production
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    // Create payment
    public function createPayment(Request $request, Transaksi $transaksi)
    {
        try {
            // Prepare transaction data for Midtrans Snap API
            $params = [
                'transaction_details' => [
                    'order_id' => 'TRX-' . strtoupper(uniqid()),
                    'gross_amount' => $transaksi->total_harga,
                ],
                'customer_details' => [
                    'first_name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                ]
            ];

            // Get Snap token from Midtrans
            $snapToken = Snap::getSnapToken($params);

            // Create payment record in database
            $payment = Payment::create([
                'transaksi_id' => $transaksi->id,
                'midtrans_order_id' => $params['transaction_details']['order_id'],
                'status' => 'pending',
                'payment_type' => 'snap',
                'payment_url' => "https://app.sandbox.midtrans.com/snap/v2/vtweb/$snapToken"
            ]);

            return response()->json([
                'status' => 'success',
                'snap_token' => $snapToken
            ]);
        } catch (\Exception $e) {
            \Log::error('Error creating payment: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Gagal membuat pembayaran.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function handleCallback(Request $request)
    {
        \Log::info('Midtrans callback received: ', $request->all());
    
        try {
            $orderId = $request->input('order_id');
            $transactionStatus = $request->input('transaction_status');
    
            if (!$orderId || !$transactionStatus) {
                \Log::error('Order ID or Transaction Status missing');
                return response()->json(['status' => 'error', 'message' => 'Invalid callback data']);
            }

            // Get the payment record using the order_id from the callback
            $payment = Payment::where('midtrans_order_id', $orderId)->first();
    
            if (!$payment) {
                \Log::error('Payment not found for order_id: ' . $orderId);
                return response()->json(['status' => 'error', 'message' => 'Payment not found']);
            }

            // Using Transaction::status to check the transaction status from Midtrans
            $response = Transaction::status($orderId);
    
            \Log::info('Midtrans status response: ', (array) $response);
    
            if ($response->transaction_status == 'settlement' || $response->transaction_status == 'capture') {
                // Update payment status to 'settlement'
                $payment->status = 'settlement';
                $payment->save();

                // Update transaksi status to 'lunas'
                $transaksi = $payment->transaksi;
                $transaksi->status = 'proses';
                $transaksi->save();
            } else {
                // Update payment status to 'failed'
                $payment->status = 'failed';
                $payment->save();

                // Update transaksi status to 'gagal'
                $transaksi = $payment->transaksi;
                $transaksi->status = 'gagal';
                $transaksi->save();
            }
    
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            \Log::error('Error during callback processing: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'An error occurred while processing the callback']);
        }
    }
}
