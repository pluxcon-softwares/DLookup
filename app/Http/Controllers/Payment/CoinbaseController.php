<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

use App\Models\Post;
use App\Models\Payment;

class CoinbaseController extends Controller
{
    public function addFund()
    {
        $title = 'Payments / Add Funds';
        $payments = Payment::where('customer_id', Auth::user()->id)->get();
        return view('user.wallet')->with(['title'=>$title, 'payments'=>$payments]);
    }

    public function processFund(Request $request)
    {
        $request->validate([
            'fund'  =>  'required|numeric'
        ]);

        $charge = Http::withHeaders([
            'X-CC-Api-Key' => '2dfc9a63-7bd6-481e-ae42-6825fa32a507',
            'X-CC-Version'  =>  '2018-03-22'
            ])
            ->post('https://api.commerce.coinbase.com/charges',[
                'name'  => 'Check-Lite Payment',
                'description' => 'Fund your Check-Lite Wallet for better services',
                'pricing_type'=>'fixed_price',
                'local_price' => [
                    'amount' => $request->fund,
                    'currency' => 'USD'
                ],
                'metadata' => [
                    'customer_id' => Auth::user()->id,
                    'customer_name' => Auth::user()->username
                ],
                'redirect_url' => route('user.payment-complete'),
                'cancel_url' => route('user.payment-cancel')
            ]);

        if($charge->successful())
        {
            $charge_response = $charge->json();
            $payment = new Payment;
            $payment->customer_id = intval($charge['data']['metadata']['customer_id']);
            $payment->customer_name = $charge['data']['metadata']['customer_name'];
            $payment->address = $charge['data']['addresses']['bitcoin'];
            $payment->code = $charge['data']['code'];
            $payment->transaction_id = $charge['data']['id'];
            $payment->local_amount = floatval($charge['data']['pricing']['local']['amount']);
            $payment->local_currency = $charge['data']['pricing']['local']['currency'];
            $payment->bitcoin_amount = $charge['data']['pricing']['bitcoin']['amount'];
            $payment->bitcoin_currency = $charge['data']['pricing']['bitcoin']['currency'];
            $payment->save();

            return redirect($charge['data']['hosted_url']);
        }
        else{
            Log::info($charge);
        }
    }

    public function paymentComplete()
    {
        $title = 'Payment Completed';
        return view('user.payment-complete')->with(['title'=>$title]);
    }

    public function paymentCancel()
    {
        $title = 'Payment Cancelled';
        return view('user.payment-cancel')->with(['title'=>$title]);
    }
}
