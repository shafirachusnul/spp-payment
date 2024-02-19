<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    public function handleLogin(Request $req) {
        $validated = Validator::make($req->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if($validated->fails()) return redirect()->back()->withErrors($validated);

        $rememberMe = true;
        if($req->remember == null) {
            $rememberMe = false;
        }
        if($rememberMe == true) {
            Cookie::queue('last_email',$req->email, 60 * 24 * 7  );
        }
        $credentials = $req->only('email', 'password');
        if(Auth::attempt($credentials,$rememberMe)){
            $req->session()->regenerate();
            return redirect()->intended(route('admin.paymentList'));
        } else {
            return redirect()->back()->withErrors("invalid credentials!");
        }
    }

    public function handleLogout(Request $req){
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect()->route('guest.login');
    }

    public function studentList(){
        $students = DB::table('users')
        ->select('users.id', 'users.name', 'users.email')
        ->selectRaw('SUM(payments.fee) AS total_fee')
        ->selectRaw('SUM(CASE WHEN payment_headers.is_payment_done = 1 THEN payments.fee ELSE 0 END) AS payments_done')
        ->join('payment_headers', 'users.id', '=', 'payment_headers.user_id')
        ->join('payments', 'payments.id', '=', 'payment_headers.payment_id')
        ->where('users.role', '=', 'student')
        ->groupBy('users.id', 'users.name', 'users.email')
        ->get();

        return view('admin.studentList', compact('students'));
    }

    public function adminList(){
        $admins = DB::table('users')
        ->select('users.id', 'users.name', 'users.email')
        ->where('users.role', '=', 'admin')
        ->groupBy('users.id', 'users.name', 'users.email')
        ->get();

        return view('admin.adminList', compact('admins'));
    }

    public function insertStudent(){
        return view('admin.insertStudent');
    }

    public function handleInsertStudent(Request $req) {
        $validated = Validator::make($req->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5',
        ]);

        if($validated->fails()){
            return redirect()->back()->withErrors($validated);
        }

        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->save();

        return redirect()->route('admin.studentList')->with('message','success create new post!');
    }

    public function insertAdmin(){
        return view('admin.insertAdmin');
    }

    public function handleInsertAdmin(Request $req) {
        $validated = Validator::make($req->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5',
        ]);

        if($validated->fails()){
            return redirect()->back()->withErrors($validated);
        }

        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->role = 'admin';
        $user->save();

        return redirect()->route('admin.adminList')->with('message','success create new post!');
    }


}
