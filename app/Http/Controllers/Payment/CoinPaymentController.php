<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hexters\CoinPayment\CoinPayment;

use App\Models\Post;
use App\Models\Payment;

class CoinPaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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

        $transaction['order_id'] = uniqid(); //invoice number
        $transaction['amountTotal'] = (FLOAT) $request->fund;
        $transaction['note'] = 'Check-Lite Payment';
        $transaction['buyer_name'] = Auth::user()->username;
        $transaction['buyer_email'] = Auth::user()->email;
        $transaction['redirect_url'] = route('user.payment-complete');
        $transaction['cancel_url'] = route('user.payment-cancel');

        $transaction['items'][] = [
            'itemDescription' => 'Funding Your Check-Lite Wallet',
            'itemPrice' => (FLOAT) $request->fund,
            'itemQty'   => (INT) 1,
            'itemSubtotalAmount' => (FLOAT) $request->fund
        ];

        $button_link = CoinPayment::generatelink($transaction);
        return redirect($button_link);
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
