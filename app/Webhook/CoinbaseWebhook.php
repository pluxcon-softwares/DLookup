<?php

namespace App\Webhook;

use \Spatie\WebhookClient\ProcessWebhookJob;
use Illuminate\Support\Facades\Log;

use App\Models\Payment;
use App\Models\User;

class CoinbaseWebhook extends ProcessWebhookJob
{
    public function handle()
    {
        $payment = Payment::where('code', $this->webhookCall['payload']['event']['data']['code'])
                            ->where('transaction_id', $tihs->webhookCall['payload']['event']['data']['id'])
                            ->first();

        $charge_type = $this->webhookCall['payload']['event']['type'];
        switch($charge_type)
        {
            case 'charge:created':
                $payment->status = 'created';
                $payment->save();
            break;

            case 'charge:confirmed':
                $payment->status = 'confirmed';
                $payment->save();
                $user = User::find($payment->customer_id);
                $user->wallet = ($user->wallet + $payment->local_amount);
                $user->save();
            break;

            case 'charge:failed':
                $payment->status = 'failed';
                $payment->save();
            break;

            case 'charge:delayed':
                $payment->status = 'delayed';
                $payment->save();
                $user = User::find($payment->customer_id);
                $user->wallet = ($user->wallet + $payment->local_amount);
                $user->save();
            break;

            case 'charge:pending':
                $payment->status = 'pending';
                $payment->save();
            break;
        }
    }
}
