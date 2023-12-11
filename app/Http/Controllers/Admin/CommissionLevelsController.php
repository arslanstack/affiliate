<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\CommissionPercentage;
use Illuminate\Support\Facades\Validator;

class CommissionLevelsController extends Controller
{
    public function index(){
        $levels = CommissionPercentage::all();
        return view('admin.commission_percentage.index', compact('levels'));
    }

    public function update(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'commission_percentage' => 'required|numeric|min:0|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $level = CommissionPercentage::find($request->id);
        $level->commission_percentage = $request->commission_percentage;
        $level->save();

        return redirect()->back()->with('success', 'Commission Percentage Updated Successfully');
    }
}
