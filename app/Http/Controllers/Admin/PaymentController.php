<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Payment;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin_auth');
    }

    public function allPayments()
    {
        $title = "All Payment";
        $payments = Payment::where('status', 'confirmed')
                    ->get();

        $paymentTotal = null;
        foreach($payments as $p)
        {
            $paymentTotal += $p->local_amount;
        }

        return view('admin.payment.all-payment')
        ->with(['title'=>$title, 'payments'=>$payments, 'paymentTotal' => $paymentTotal]);
    }
}
