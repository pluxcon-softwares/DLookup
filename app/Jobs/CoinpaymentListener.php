<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CoinpaymentListener implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $transaction;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($transaction) {
        $this->transaction = $transaction;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {

        /**
         * Handle your transaction here
         * the parameter is :
         *
         * address
         * amount
         * amountf
         * coin
         * confirms_needed
         * payment_address
         * qrcode_url
         * received
         * receivedf
         * recv_confirms
         * status
         * status_text
         * status_url
         * timeout
         * txn_id
         * type
         * payload
         * transaction_type --> value: new | old
         *
         * ----------------- PAYMENT STATUS -------------------
         * 0   : Waiting for buyer funds
         * 1   : Funds received and confirmed, sending to you shortly
         * 100 : Complete,
         * -1  : Cancelled / Timed Out
         *
         * ----------------------------------------------------
         *  You can use transaction_type to distinguish new transactions or old transactions
         * ----------------------------------------------------
         * Example
         *  $this->transaction['transaction_type']
         *  // out: new / old
         */
            if($this->transaction['transaction_type'] == 'old' && $this->transaction['status'] >= 100)
            {
                $user = User::where('email', $this->transaction['buyer_email'])->first();
                $user->wallet += $this->transaction['amount_total_fiat'];
                $user->save();
            }
         return 0;
    }
}