<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserEarning;
use App\Models\UserCommission;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    public function index()
    {
        // fetch 3 products from database with status = 1
        $products = Product::where('status', 1)->take(3)->get();
        return view('welcome', compact('products'));
    }
    public function shop()
    {
        // fetch all products with status = 1
        $products = Product::where('status', 1)->get();
        return view('store.shop', compact('products'));
    }
    public function product($slug)
    {
        $product = Product::where('slug', $slug)->first();
        if (!$product) {
            return redirect()->route('shop');
        }
        return view('store.product', compact('product'));
    }
    public function cart()
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $carts = Cart::where('user_id', $user_id)->get();
        } else {
            $cart = session()->get('cart');
            $carts = [];

            if ($cart) {
                foreach ($cart as $key => $value) {
                    $carts[$key] = [
                        'product_id' => $value['product_id'],
                        'quantity' => $value['quantity'],
                        'id' => $key,
                    ];
                }
            }
        }

        return view('store.cart', compact('carts'));
    }

    public function cartStore(Request $request)
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
        } else {
            $user_id = null;
        }

        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please enter valid quantity',
            ]);
        }

        if (!$user_id) {
            $cart = session()->get('cart') ?? [];

            if (isset($cart[$request->id])) {
                $cart[$request->id]['quantity'] += $request->quantity;
            } else {
                $cart[$request->id] = [
                    "product_id" => $request->id,
                    "quantity" => $request->quantity,
                ];
            }

            session()->put('cart', $cart);
        } else {
            $cart = Cart::where('user_id', $user_id)
                ->where('product_id', $request->id)
                ->first();

            if ($cart) {
                $cart->quantity += $request->quantity;
                $cart->save();
            } else {
                $cart = new Cart();
                $cart->user_id = $user_id;
                $cart->product_id = $request->id;
                $cart->quantity = $request->quantity;
                $cart->save();
            }
        }
        // calculate total cart items for each case authenticated or non authenticated
        if (Auth::check()) {
            $total = Cart::where('user_id', auth()->id())->count();
        } else {
            $total = count(session()->get('cart', []));
        }
        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully',
            'items' => $total,
        ]);
    }
    public function cartStoreSimple(Request $request)
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
        } else {
            $user_id = null;
        }

        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Please enter valid quantity');
        }

        if (!$user_id) {
            $cart = session()->get('cart') ?? [];

            if (isset($cart[$request->id])) {
                $cart[$request->id]['quantity'] += $request->quantity;
            } else {
                $cart[$request->id] = [
                    "product_id" => $request->id,
                    "quantity" => $request->quantity,
                ];
            }

            session()->put('cart', $cart);
        } else {
            $cart = Cart::where('user_id', $user_id)
                ->where('product_id', $request->id)
                ->first();

            if ($cart) {
                $cart->quantity += $request->quantity;
                $cart->save();
            } else {
                $cart = new Cart();
                $cart->user_id = $user_id;
                $cart->product_id = $request->id;
                $cart->quantity = $request->quantity;
                $cart->save();
            }
        }
        return redirect()->route('cart');
    }

    public function updateCart($cartItemId, $newQuantity)
    {
        if (Auth::check()) {
            $cartItem = Cart::findOrFail($cartItemId);
            $cartItem->quantity = $newQuantity;
            $cartItem->save();

            $subtotal = get_product_subtotal($cartItem->product_id, $newQuantity);

            $total = get_total(Cart::where('user_id', auth()->id())->get());
        } else {
            $cart = session()->get('cart');
            $cart[$cartItemId]['quantity'] = $newQuantity;
            session()->put('cart', $cart);

            $subtotal = get_product_subtotal($cart[$cartItemId]['product_id'], $newQuantity);

            $total = get_total($cart);
        }

        return response()->json([
            'subtotal' => $subtotal,
            'total' => $total,
        ]);
    }
    public function removeCartItem($cartItemId)
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $cartItem = Cart::where('user_id', $user_id)->find($cartItemId);

            if ($cartItem) {
                $cartItem->delete();
            }
        } else {
            $cart = session()->get('cart');
            if (isset($cart[$cartItemId])) {
                unset($cart[$cartItemId]);
                session()->put('cart', $cart);
            }
        }
        $carts = $this->getCarts();
        $total = $this->getTotal($carts);

        return response()->json([
            'subtotal' => get_total($carts),
            'total' => $total,
        ]);
    }
    private function getCarts()
    {
        // Logic to get updated cart items based on the user's authentication status
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            return Cart::where('user_id', $user_id)->get();
        } else {
            return session()->get('cart', []);
        }
    }

    private function getTotal($carts)
    {
        $total = 0;
        foreach ($carts as $cart) {
            if (is_array($cart)) {
                $total += get_product_subtotal($cart['product_id'], $cart['quantity']);
            } else {
                $total += get_product_subtotal($cart->product_id, $cart->quantity);
            }
        }
        return $total;
    }
    public function checkout()
    {
        

        if (!Auth::check()) {
            // if cart in session is empty then redirect to shop page
            if (count(session()->get('cart', [])) == 0) {
                return redirect()->route('login');
            }
            session()->put('checkout', true);
            return redirect()->route('login');
        }
        // if cart in database is empty then redirect to shop page
        if (Cart::where('user_id', auth()->id())->count() == 0) {
            return redirect()->route('shop');
        }
        // Logic to get updated cart items based on the user's authentication status
        $carts = $this->getCarts();
        $total = $this->getTotal($carts);
        // Make Order Record and Order Items Records
        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'user_id' => auth()->id(),
            'status' => 1,
            'total' => $total,
            'notes' => '',
        ]);

        foreach ($carts as $cart) {
            if (is_array($cart)) {
                $product = Product::find($cart['product_id']);
                $orderItem = new OrderItem([
                    'product_id' => $cart['product_id'],
                    'product_name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $cart['quantity'],
                    'total' => get_product_subtotal($cart['product_id'], $cart['quantity']),
                    'notes' => '',
                ]);
                $order->items()->save($orderItem);
                // clear the cart 
                session()->forget('cart');
                // delete these cart items from database
                Cart::where('user_id', auth()->id())->delete();
            } else {
                $product = Product::find($cart->product_id);
                $orderItem = new OrderItem([
                    'product_id' => $cart->product_id,
                    'product_name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $cart->quantity,
                    'total' => get_product_subtotal($cart->product_id, $cart->quantity),
                    'notes' => '',
                ]);
                $order->items()->save($orderItem);
                // clear the cart if exists
                session()->forget('cart');
                // delete these cart items from database
                Cart::where('user_id', auth()->id())->delete();
            }
        }
        $shopper = User::where('id', auth()->id())->first();
        $parent = get_parent($shopper->id);
        
        $grandparent = [];
        $greatgrandparent = [];

        if ($parent != null) {
            $grandparent = get_parent($parent->id);
            $commission_level_id = 1;
            $commission_amount = $total * ((get_commission_percentage($commission_level_id) / 100));
            $commission_percentage = get_commission_percentage($commission_level_id);
            $order_amount = $total;
            $user_commission = new UserCommission([
                'user_id' => $parent->id,
                'order_id' => $order->id,
                'shopper_id' => $shopper->id,
                'commission_level_id' => $commission_level_id,
                'commission_amount' => $commission_amount,
                'commission_percentage' => $commission_percentage,
                'order_amount' => $order->total,
            ]);
            $user_commission->save();
            $user_earning = UserEarning::where('user_id', $parent->id)->first();
            if($user_earning == null){
                $user_earning = new UserEarning([
                    'user_id' => $parent->id,
                    'total_earnings' => 0,
                    'available_balance' => 0,
                ]);
                $user_earning->save();
                $user_earning = UserEarning::where('user_id', $parent->id)->first();
            }
            $user_earning->total_earnings = $user_earning->total_earnings + $commission_amount;
            $user_earning->available_balance = $user_earning->available_balance + $commission_amount;
            $user_earning->save();
        }

        if ($grandparent != null) {
            $greatgrandparent = get_parent($grandparent->id);
            $commission_level_id = 2;
            $commission_amount = $total * ((get_commission_percentage($commission_level_id) / 100));
            $commission_percentage = get_commission_percentage($commission_level_id);
            $order_amount = $total;
            $user_commission = new UserCommission([
                'user_id' => $grandparent->id,
                'order_id' => $order->id,
                'shopper_id' => $shopper->id,
                'commission_level_id' => $commission_level_id,
                'commission_amount' => $commission_amount,
                'commission_percentage' => $commission_percentage,
                'order_amount' => $order->total,
            ]);
            $user_commission->save();
            $user_earning = UserEarning::where('user_id', $grandparent->id)->first();
            if($user_earning == null){
                $user_earning = new UserEarning([
                    'user_id' => $grandparent->id,
                    'total_earnings' => 0,
                    'available_balance' => 0,
                ]);
                $user_earning->save();
                $user_earning = UserEarning::where('user_id', $grandparent->id)->first();
            }
            $user_earning->total_earnings = $user_earning->total_earnings + $commission_amount;
            $user_earning->available_balance = $user_earning->available_balance + $commission_amount;
            $user_earning->save();
        }

        if ($greatgrandparent != null) {
            $commission_level_id = 3;
            $commission_amount = $total * ((get_commission_percentage($commission_level_id) / 100));
            $commission_percentage = get_commission_percentage($commission_level_id);
            $order_amount = $total;
            $user_commission = new UserCommission([
                'user_id' => $greatgrandparent->id,
                'order_id' => $order->id,
                'shopper_id' => $shopper->id,
                'commission_level_id' => $commission_level_id,
                'commission_amount' => $commission_amount,
                'commission_percentage' => $commission_percentage,
                'order_amount' => $order->total,
            ]);
            $user_commission->save();
            $user_earning = UserEarning::where('user_id', $greatgrandparent->id)->first();
            if($user_earning == null){
                $user_earning = new UserEarning([
                    'user_id' => $greatgrandparent->id,
                    'total_earnings' => 0,
                    'available_balance' => 0,
                ]);
                $user_earning->save();
                $user_earning = UserEarning::where('user_id', $greatgrandparent->id)->first();
            }
            $user_earning->total_earnings = $user_earning->total_earnings + $commission_amount;
            $user_earning->available_balance = $user_earning->available_balance + $commission_amount;
            $user_earning->save();
        }
        return redirect()->route('show.order', $order->order_number);
    }
    public function showOrder($order_number)
    {
        // if authenticated only then show else redirect to login page
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $order = Order::where('order_number', $order_number)->with('items')->first();
        return view('store.order', compact('order'));
    }
}
