<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    public function editPassword(Request $request)
    {
        // dd($request->all());
        $user = Admin::find(Auth::guard('admin')->user()->id);
        if($request->password != $request->c_password){
            return redirect()->back()->with('error', 'Password and Confirm Password does not match');
        }
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->back()->with('success', 'Your password is updated successfully');
    }
    public function editProfile(Request $request)
    {
        // dd($request->all());
        $user = Admin::find(Auth::guard('admin')->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        if ($request->hasFile('profile_img')) {
            $file = $request->file('profile_img');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/profile/', $filename);
            $user->image = $filename;
            $user->save();
        }
        return redirect()->back()->with('success', 'Your profile is updated successfully');
    }
    public function profile()
    {
        return view('admin.profile');
    }
    
}
