<?php

namespace App\Http\Controllers;

use App\Models\PaymentHeader;
use Illuminate\Http\Request;

class PaymentHeaderController extends Controller
{
    function handleMappingStudent($user_id,$payment_id) {
        $paymentHeader = new PaymentHeader;
        $paymentHeader->user_id = $user_id;
        $paymentHeader->payment_id = $payment_id;
        $paymentHeader->is_payment_done = false;
        $paymentHeader->is_notify_done = false;
        $paymentHeader->save();
        return redirect()->back();
    }

    function handleRemoveMappingStudent($user_id,$payment_id) {
        $paymentHeader = PaymentHeader::where('user_id', $user_id)->where('payment_id', $payment_id)->first();
        $paymentHeader->delete();
        return redirect()->back();
    }
}
