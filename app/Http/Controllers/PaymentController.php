<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PaymentHeader;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function paymentList(){
        $payments = Payment::all();
        return view('admin.paymentList', compact('payments'));
    }

    public function studentPayment(){
        $payments = DB::table('users')
        ->select('payments.fee', 'payments.title', 'payments.description', 'payments.deadline', 'payment_headers.is_payment_done', 'payments.id as payment_id')
        ->join('payment_headers', 'users.id', '=', 'payment_headers.user_id')
        ->join('payments', 'payment_headers.payment_id', '=', 'payments.id')
        ->where('users.id', '=', Auth::user()->id)
        ->get();

        $total_payment = DB::table('users')
        ->selectRaw('SUM(CASE WHEN payment_headers.is_payment_done = 1 THEN payments.fee ELSE 0 END) AS payments_done')
        ->join('payment_headers', 'users.id', '=', 'payment_headers.user_id')
        ->join('payments', 'payments.id', '=', 'payment_headers.payment_id')
        ->where('users.role', '=', 'student')
        ->where('users.id', '=', Auth::user()->id)
        ->groupBy('users.id')
        ->first();

        return view('student.dashboard', compact('payments','total_payment'));
    }

    public function handleStudentPayment($payment_id) {
        $user_id = Auth::user()->id;
        $paymentHeader = PaymentHeader::where('user_id', $user_id)->where('payment_id', $payment_id)->first();
        $paymentHeader->is_payment_done = 1;
        $paymentHeader->save();
        return redirect()->back();
    }

    public function insertPayment(){
        return view('admin.insertPayment');
    }
    public function handleInsertPayment(Request $req){
        $validated = Validator::make($req->all(), [
            'title' => 'required|unique:payments,title',
            'description' => 'required',
            'fee' => 'required|numeric|min:500000',
            'deadline' => 'required',
        ]);

        if($validated->fails()){
            return redirect()->back()->withErrors($validated);
        }

        $payment = new Payment;
        $payment->title = $req->title;
        $payment->description = $req->description;
        $payment->fee = $req->fee;
        $payment->deadline = $req->deadline;
        $payment->save();

        return redirect()->route('admin.paymentList')->with('message','success create new payment!');
    }

    public function updatePayment($id) {
        $payment = Payment::find($id);
        return view('admin.updatePayment', compact('payment'));
    }
    public function handleUpdatePayment(Request $req, $id) {
        $validated = Validator::make($req->all(), [
            'title' => 'required|unique:payments,title',
            'description' => 'required',
            'fee' => 'required|numeric|min:500000',
            'deadline' => 'required',
        ]);

        if($validated->fails()){
            return redirect()->back()->withErrors($validated);
        }

        $payment = Payment::find($id);
        $payment->title = $req->title;
        $payment->description = $req->description;
        $payment->fee = $req->fee;
        $payment->deadline = $req->deadline;
        $payment->save();

        return redirect()->route('admin.paymentList')->with('message','success update new payment!');
    }

    public function handleDeletePayment($id) {
        Payment::destroy($id);
        return redirect()->back();
    }

    public function mappingStudent($payment_id) {
        $payment = Payment::find($payment_id);
        $students = User::where('role', 'student')->get();
        $payment_headers = PaymentHeader::all();
        return view('admin.mappingStudent',compact(['payment', 'students','payment_headers']));
    }
}
