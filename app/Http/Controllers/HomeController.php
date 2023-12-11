<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\UserCommission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::find(Auth::id());
        if ($user->status == 0) {
            // logout user
            Auth::logout();
            return redirect()->back()->with('error', 'Your account is not active. Please contact admin.');
        }
        $commissions = UserCommission::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        return view('user.home', compact('commissions'));
    }
    public function earnings(){
        $commissions = UserCommission::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        return view('user.earning', compact('commissions'));
    }
    public function referrals(){
        return view('user.referrals');
    }
    public function profile()
    {
        return view('user.profile');
    }
    public function orders()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        return view('user.orders', compact('orders'));
    }
    public function editProfile(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users,email,' . Auth::id(),
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Please enter a unique email address');
        }
        // dd($request->all());
        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/profile/', $filename);
            $user->image = $filename;
            $user->save();
        }
        return redirect()->back()->with('success', 'Your profile is updated successfully');
    }
}
