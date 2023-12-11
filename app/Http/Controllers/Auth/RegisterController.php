<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\UserEarning;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Affiliate;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'referral_code' => $this->generateReferralCode(),
        ]);

        // Create an affiliate record for the user
        $affiliate = Affiliate::create([
            'user_id' => $user->id,
            'parent_id' => $this->getParentId($data['referral_code']),
        ]);

        return $user;
    }
    protected function registered(Request $request, $user)
    {
        $this->moveItemsFromSessionToDatabase($user->id);
        if(session()->has('checkout')) {
            return redirect()->route('checkout');
        }
        // if user doesn't have a record in UserEarning then create one
        if (!UserEarning::where('user_id', $user->id)->exists()) {
            $userEarning = new UserEarning([
                'user_id' => $user->id,
            ]);
            $userEarning->save();
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

    protected function generateReferralCode()
    {
        do {
            $referralCode = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
        } while (User::where('referral_code', $referralCode)->exists());

        return $referralCode;
    }

    protected function getParentId($referralCode)
    {
        $parentUser = User::where('referral_code', $referralCode)->first();
        return $parentUser ? $parentUser->id : null;
    }
}
