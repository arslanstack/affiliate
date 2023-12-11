<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('generateReferralCode')) {
    function generateReferralCode()
    {
        $referral_code = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
        $check = \App\Models\User::where('referral_code', $referral_code)->first();
        if ($check) {
            generateReferralCode();
        }
        return $referral_code;
    }
}
if (!function_exists('get_parent')) {
    function get_parent($user_id)
    {
        $parent = \App\Models\Affiliate::where('user_id', $user_id)->first();
        if ($parent) {
            $parent->parent_id;
            $parent_info = \App\Models\User::where('id', $parent->parent_id)->first();
            return $parent_info;
        }
        return null;
    }
}
if (!function_exists('get_grandparent')) {
    function get_grandparent($user_id)
    {
        $parent = get_parent($user_id);
        if ($parent) {
            $grandparent = get_parent($parent->id);
            if ($grandparent) {
                $grandparent_info = \App\Models\User::where('id', $grandparent->id)->first();
                return $grandparent_info;
            }
        }
        return null;
    }
}
if (!function_exists('get_great_grandparent')) {
    function get_great_grandparent($user_id)
    {
        $grandparent = get_grandparent($user_id);
        if ($grandparent) {
            $great_grandparent = get_parent($grandparent->id);
            if ($great_grandparent) {
                $great_grandparent_info = \App\Models\User::where('id', $great_grandparent->id)->first();
                return $great_grandparent_info;
            }
        }
        return null;
    }
}

if (!function_exists('get_all_children')) {
    function get_all_children($id)
    {
        $children = \App\Models\Affiliate::where('parent_id', $id)->get();
        if ($children->isNotEmpty()) {
            $childs = [];
            foreach ($children as $child) {
                $child_info = \App\Models\User::where('id', $child->user_id)->first();
                $child_info->children = get_all_children($child->user_id);
                $childs[] = $child_info;
            }
            return $childs;
        }
        return null;
    }
}

if (!function_exists('tree_builder')) {
    function tree_builder($user_id)
    {
        $user = \App\Models\User::where('id', $user_id)->first();
        $parent = get_parent($user_id);
        $grandparent = get_grandparent($user_id);
        $great_grandparent = get_great_grandparent($user_id);
        $children = get_all_children($user_id);

        $html = '<ul class="tree">
            ' . ($great_grandparent ? '<li><span><img src="' . asset('uploads/profile/' . ($great_grandparent ? ($great_grandparent['image'] ? $great_grandparent['image'] : 'avatar.jpg') : 'avatar.jpg')) . ' "style="width:40px; height:40px; border-radius: 100px;"><br><h6 class="mt-3"><b>' . ($great_grandparent ? $great_grandparent['name'] : '') . '</b></h6><p>Parent Affiliate Level 3</p></span>' :  '<li>') . '
            <ul>
                ' . ($grandparent ? '<li><span><img src="' . asset('uploads/profile/' . ($grandparent ? ($grandparent['image'] ? $grandparent['image'] : 'avatar.jpg') : 'avatar.jpg')) . ' "style="width:40px; height:40px; border-radius: 100px;"><br><h6 class="mt-3"><b>' . ($grandparent ? $grandparent['name'] : '') . '</b></h6><p>Parent Affiliate Level 2</p></span>' : '<li>') . '
                    <ul>
                        ' . ($parent ? '<li><span><img src="' . asset('uploads/profile/' . ($parent ? ($parent['image'] ? $parent['image'] : 'avatar.jpg') : 'avatar.jpg')) . ' "style="width:40px; height:40px; border-radius: 100px;"><br><h6 class="mt-3"><b>' . ($parent ? $parent['name'] : '') . '</b></h6><p>Parent Affiliate Level 1</p></span>' : '<li>') . '
                            <ul>
                                <li><span style=""><img src="' . asset('uploads/profile/' . ($user->image ? $user->image : 'avatar.jpg')) . ' "style="width:40px; height:40px; border-radius: 100px;"><br><h6 class="mt-3"><b>' . $user->name . '</b></h6><p>You</p></span>';

        if ($children) {
            $html .= '<ul>';
            foreach ($children as $child) {
                $html .= '<li><span><img src="' . asset('uploads/profile/' . ($child->image ? $child->image : 'avatar.jpg')) . ' "style="width:40px; height:40px; border-radius: 100px;"><br><h6 class="mt-3"><b>' . $child->name . '</b></h6><p>Child Affiliate Level 1</p></span>';

                // Display grandchildren of the current child
                if ($child->children) {
                    $html .= '<ul>';
                    foreach ($child->children as $grandchild) {
                        $html .= '<li><span><img src="' . asset('uploads/profile/' . ($grandchild->image ? $grandchild->image : 'avatar.jpg')) . ' "style="width:40px; height:40px; border-radius: 100px;"><br><h6 class="mt-3"><b>' . $grandchild->name . '</b></h6><p>Child Affiliate Level 2</p></span>';

                        // Display great-grandchildren of the current grandchild
                        if ($grandchild->children) {
                            $html .= '<ul>';
                            foreach ($grandchild->children as $greatGrandchild) {
                                $html .= '<li><span><img src="' . asset('uploads/profile/' . ($greatGrandchild->image ? $greatGrandchild->image : 'avatar.jpg')) . ' "style="width:40px; height:40px; border-radius: 100px;"><br><h6 class="mt-3"><b>' . $greatGrandchild->name . '</b></h6><p>Child Affiliate Level 3</p></span></li>';
                            }
                            $html .= '</ul>';
                        }

                        $html .= '</li>';
                    }
                    $html .= '</ul>';
                }

                $html .= '</li>';
            }
            $html .= '</ul>';
        }

        $html .= '</li> </ul> </li> </ul>';
        $html .= '</li> </ul> </li> </ul>';

        return $html;
    }
}
if (!function_exists('admin_tree_builder')) {
    function admin_tree_builder($user_id)
    {
        $user = \App\Models\User::where('id', $user_id)->first();
        $parent = get_parent($user_id);
        $grandparent = get_grandparent($user_id);
        $great_grandparent = get_great_grandparent($user_id);
        $children = get_all_children($user_id);

        $html = '<ul class="tree">
        ' . ($great_grandparent ? '<li><a target="_blank" href="' . ($great_grandparent ? url('/admin/user-view/' . $great_grandparent->id) : '#') . '"><span><img src="' . asset('uploads/profile/' . ($great_grandparent ? ($great_grandparent['image'] ? $great_grandparent['image'] : 'avatar.jpg') : 'avatar.jpg')) . ' "style="width:80px; height:80px; border-radius: 100px;"><br><h6 class="mt-3"><b>' . ($great_grandparent ? $great_grandparent['name'] : 'No Great Grandparent') . '</b></h6><p>Parent Affiliate Level 3</p></span></a>' : '<li>') . '
            <ul>
                ' . ($grandparent ? '<li><a target="_blank" href="' . ($grandparent ? url('/admin/user-view/' . $grandparent->id) : '#') . '"><span><img src="' . asset('uploads/profile/' . ($grandparent ? ($grandparent['image'] ? $grandparent['image'] : 'avatar.jpg') : 'avatar.jpg')) . ' "style="width:80px; height:80px; border-radius: 100px;"><br><h6 class="mt-3"><b>' . ($grandparent ? $grandparent['name'] : 'No Grandparent') . '</b></h6><p>Parent Affiliate Level 2</p></span></a>' : '<li>') . '
                    <ul>
                        ' . ($parent ? '<li><a target="_blank" href="' . ($parent ? url('/admin/user-view/' . $parent->id) : '#') . '"><span><img src="' . asset('uploads/profile/' . ($parent ? ($parent['image'] ? $parent['image'] : 'avatar.jpg') : 'avatar.jpg')) . ' "style="width:80px; height:80px; border-radius: 100px;"><br><h6 class="mt-3"><b>' . ($parent ? $parent['name'] : 'No Parent') . '</b></h6><p>Parent Affiliate Level 1</p></span></a>' : '<li>') . '
                            <ul>
                                <li><span style=""><img src="' . asset('uploads/profile/' . ($user->image ? $user->image : 'avatar.jpg')) . ' "style="width:80px; height:80px; border-radius: 100px;"><br><h6 class="mt-3"><b>' . $user->name . '</b></h6><p>User</p></span>';

        if ($children) {
            $html .= '<ul>';
            foreach ($children as $child) {
                $html .= '<li><a target="_blank" href="' . ($child ? url('/admin/user-view/' . $child->id) : '#') . '"><span><img src="' . asset('uploads/profile/' . ($child->image ? $child->image : 'avatar.jpg')) . ' "style="width:80px; height:80px; border-radius: 100px;"><br><h6 class="mt-3"><b>' . $child->name . '</b></h6><p>Child Affiliate Level 1</p></span></a>';

                // Display grandchildren of the current child
                if ($child->children) {
                    $html .= '<ul>';
                    foreach ($child->children as $grandchild) {
                        $html .= '<li><a target="_blank" href="' . ($grandchild ? url('/admin/user-view/' . $grandchild->id) : '#') . '"><span><img src="' . asset('uploads/profile/' . ($grandchild->image ? $grandchild->image : 'avatar.jpg')) . ' "style="width:80px; height:80px; border-radius: 100px;"><br><h6 class="mt-3"><b>' . $grandchild->name . '</b></h6><p>Child Affiliate Level 2</p></span></a>';

                        // Display great-grandchildren of the current grandchild
                        if ($grandchild->children) {
                            $html .= '<ul>';
                            foreach ($grandchild->children as $greatGrandchild) {
                                $html .= '<li><a target="_blank" href="' . ($greatGrandchild ? url('/admin/user-view/' . $greatGrandchild->id) : '#') . '"><span><img src="' . asset('uploads/profile/' . ($greatGrandchild->image ? $greatGrandchild->image : 'avatar.jpg')) . ' "style="width:80px; height:80px; border-radius: 100px;"><br><h6 class="mt-3"><b>' . $greatGrandchild->name . '</b></h6><p>Child Affiliate Level 3</p></span></li></a>';
                            }
                            $html .= '</ul>';
                        }

                        $html .= '</li>';
                    }
                    $html .= '</ul>';
                }

                $html .= '</li>';
            }
            $html .= '</ul>';
        }

        $html .= '</li> </ul> </li> </ul>';
        $html .= '</li> </ul> </li> </ul>';

        return $html;
    }
}
if (!function_exists('calculate_referred_affiliates')) {
    function calculate_referred_affiliates($id)
    {
        $affiliates_count = \App\Models\Affiliate::where('parent_id', $id)->count();
        return $affiliates_count;
    }
}
if (!function_exists('get_product_image')) {
    function get_product_image($id)
    {
        $product = \App\Models\Product::where('id', $id)->first();
        return $product ? $product->image : null;
    }
}

if (!function_exists('get_product_name')) {
    function get_product_name($id)
    {
        $product = \App\Models\Product::where('id', $id)->first();
        return $product ? $product->name : null;
    }
}

if (!function_exists('get_product_price')) {
    function get_product_price($id)
    {
        $product = \App\Models\Product::where('id', $id)->first();
        return $product ? $product->price : null;
    }
}
if (!function_exists('get_product_slug')) {
    function get_product_slug($id)
    {
        $product = \App\Models\Product::where('id', $id)->first();
        return $product ? $product->slug : null;
    }
}

if (!function_exists('get_product_subtotal')) {
    function get_product_subtotal($id, $quantity)
    {
        $product = \App\Models\Product::where('id', $id)->first();
        return $product ? $product->price * $quantity : 0;
    }
}

if (!function_exists('get_total')) {
    function get_total($carts)
    {
        $total = 0;
        foreach ($carts as $cart) {
            $total += get_product_subtotal($cart['product_id'], $cart['quantity']);
        }
        return $total;
    }
}

if (!function_exists('count_cart_items')) {
    function count_cart_items()
    {
        // if user authenticated then from db else from sessions
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $carts = \App\Models\Cart::where('user_id', $user_id)->get();
            return $carts->count();
        } else {
            $cart = session()->get('cart');
            if (!$cart) {
                return 0;
            }
            return count($cart);
        }
    }
}
if (!function_exists('get_commission_percentage')) {
    function get_commission_percentage($level_id)
    {
        $level = \App\Models\CommissionPercentage::where('id', $level_id)->first();
        return $level ? $level->commission_percentage : 0;
    }
}
if (!function_exists('get_user_total_withdrawn')) {
    function get_user_total_withdrawn($user_id)
    {
        // from UserEarning
        $earning = \App\Models\UserEarning::where('user_id', $user_id)->first();
        return $earning->total_withdrawn;
    }
}
if (!function_exists('get_user_name')) {
    function get_user_name($user_id)
    {
        $user = \App\Models\User::where('id', $user_id)->first();
        return $user ? $user->name : null;
    }
}
if (!function_exists('get_user_image')) {
    function get_user_image($user_id)
    {
        $user = \App\Models\User::where('id', $user_id)->first();
        if ($user) {
            if ($user->image) {
                return $user->image;
            }
            return null;
        }
    }
}
if (!function_exists('get_user_available_balance')) {
    function get_user_available_balance($user_id)
    {
        $user = \App\Models\UserEarning::where('user_id', $user_id)->first();
        return $user ? $user->available_balance : null;
    }
}
if (!function_exists('get_user_total_earnings')) {
    function get_user_total_earnings($user_id)
    {
        $user = \App\Models\UserEarning::where('user_id', $user_id)->first();
        return $user ? $user->total_earnings : null;
    }
}
if (!function_exists('get_user_orders_count')) {
    function get_user_orders_count($user_id)
    {
        $user = \App\Models\Order::where('user_id', $user_id)->count();
        return $user;
    }
}
if (!function_exists('get_user_referrals_count')) {
    function get_user_referrals_count($user_id)
    {
        // affiliate table records count  where parent_id = $user_id
        $user = \App\Models\Affiliate::where('parent_id', $user_id)->count();
        return $user;
    }
}
