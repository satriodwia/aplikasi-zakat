<?php

namespace App\Http\Controllers;

use App\Services\CheckoutService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Midtrans\Notification;

class PaymentController extends Controller
{
    protected $checkoutService;

    public function __construct(CheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;
    }

    public function checkout(Request $request)
    {
        $data = [
            'zakat_id' => $request->input('zakat_id'),
            'muzaki_id' => auth()->id(), // Ambil dari user yang login
            'quantity' => $request->input('quantity'),
            'total_amount' => $request->input('total_amount'),
            'customer_name' => $request->input('name'),
            'customer_email' => $request->input('email'),
            'customer_phone' => $request->input('phone_number'),
        ];

        $result = $this->checkoutService->processCheckout($data);

        return response()->json([
            'snap_token' => $result['snap_token'],
            'transaction' => $result['transaction']
        ]);
    }

    public function midtransCallback(Request $request)
    {
    $notif = new Notification();

    $transaction = $notif->transaction_status;
    $order_id = $notif->order_id;

    // Temukan transaksi berdasarkan order_id
    $trx = \App\Models\Transaction::find($order_id);

    if ($trx) {
        if ($transaction == 'capture' || $transaction == 'settlement') {
            $trx->status = 'success';
            } elseif ($transaction == 'pending') {
            $trx->status = 'pending';
            } else {
            $trx->status = 'failed';
            }
        $trx->save();
        }

    return response()->json(['status' => 'ok']);
    }
}
