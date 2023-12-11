<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Cart;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        // Move items from session to database for authenticated users
        $this->moveItemsFromSessionToDatabase($user->id);
        if(session()->has('checkout')) {
            return redirect()->route('checkout');
        }
    }

    protected function moveItemsFromSessionToDatabase($userId)
    {
        $cart = session()->get('cart');

        if ($cart) {
            foreach ($cart as $productId => $item) {
                $existingCartItem = Cart::where('user_id', $userId)
                    ->where('product_id', $item['product_id'])
                    ->first();

                if ($existingCartItem) {
                    $existingCartItem->quantity += $item['quantity'];
                    $existingCartItem->save();
                } else {
                    $newCartItem = new Cart([
                        'user_id' => $userId,
                        'product_id' => $item['product_id'],
                        'quantity' => $item['quantity'],
                    ]);
                    $newCartItem->save();
                }
            }
            session()->forget('cart');
        }
    }
}
