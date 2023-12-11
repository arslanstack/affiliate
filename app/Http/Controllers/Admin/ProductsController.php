<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products|max:255',
            'short_description' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name))) . '-' . time();
        $product = new Product();
        $product->name = $request->name;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->price = $request->price;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalName();
            $destinationPath = public_path('/uploads/products');
            $image->move($destinationPath, $name);
            $product->image = $name;
        }
        $product->slug = $slug;
        $product->save();
        return redirect()->back()->with('success', 'Product added successfully!');
    }
    public function update(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'short_description' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if(isset($request->status)){
            $status = 1;
        }else{
            $status = 0;
        }

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name))) . '-' . time();
        $product = Product::find($request->id);
        $product->name = $request->name;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->price = $request->price;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalName();
            $destinationPath = public_path('/uploads/products');
            $image->move($destinationPath, $name);
            $product->image = $name;
        }
        $product->slug = $slug;
        $product->status = $status;
        $product->save();

        return redirect()->back()->with('success', 'Product updated successfully!');
    }
    public function delete(Request $request)
    {
        // dd($request->all());
        $product = Product::find($request->id); 
        if ($product) {
            $product->delete();
            return redirect()->back()->with('success', 'Product deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Product not found!');
        }
    }
}
