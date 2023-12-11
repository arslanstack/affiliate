<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }
    public function view($id)
    {
        $user = User::find($id);
        return view('admin.users.view', compact('user'));
    }
    public function activate(Request $request)
    {
        // dd($request->all());
        $user = User::find($request->id);
        $user->status = 1;
        $user->save();
        return redirect()->back()->with('success', 'User is activated successfully');
    }
    public function deactivate(Request $request)
    {
        // dd($request->all());
        $user = User::find($request->id);
        $user->status = 0;
        $user->save();
        return redirect()->back()->with('success', 'User is deactivated successfully');
    }
    public function delete(Request $request)
    {
        // dd($request->all());
        $user = User::find($request->id);
        $user->delete();
        return redirect()->back()->with('success', 'User is deleted successfully');
    }
}
