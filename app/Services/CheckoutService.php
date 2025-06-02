<?php

namespace App\Services;

use App\Repositories\TransactionRepositoryInterface;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutService
{
    protected $transactionRepository;

    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function processCheckout($data)
    {
        // Simpan transaksi ke database menggunakan repository
        $transaction = $this->transactionRepository->createTransaction([
            'zakat_id' => $data['zakat_id'],
            'muzaki_id' => $data['muzaki_id'],
            'quantity' => $data['quantity'],
            'total_amount' => $data['total_amount'],
            'status' => 'pending'
        ]);

        // Membuat Snap Token Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $transaction->id,
                'gross_amount' => $transaction->total_amount // GANTI total_price menjadi total_amount
            ],
            'customer_details' => [
                'first_name' => $data['customer_name'],
                'email' => $data['customer_email'],
                'phone' => $data['customer_phone']
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return [
            'transaction' => $transaction,
            'snap_token' => $snapToken
        ];
    }
}