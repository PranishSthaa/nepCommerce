<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $userType = (Auth::user()) ? Auth::user()->user_type : 0;
        $products = Product::all();
        return view('home.userpage', compact('products', 'userType'));
    }

    public function redirect()
    {
        $userType = Auth::user()->user_type;

        if ($userType == 1) {
            $totalProduct = Product::all()->count();
            $totalOrder = Order::all()->count();
            $totalCustomer = User::where('user_type', '=', 0)->count();
            $deliveredOrders = Order::where('delivery_status', '=', 'delivered')->with('cart.product')->get();
            $deliveredOrdersCount = $deliveredOrders->count();
            $pendingOrders = Order::where('delivery_status', '=', 'pending')->get()->count();
            $totalRevenue = 0;
            foreach ($deliveredOrders as $deliveredOrder) {
                $actualPrice = $deliveredOrder->cart->product->discount_price ? $deliveredOrder->cart->product->price - $deliveredOrder->cart->product->discount_price : $deliveredOrder->cart->product->price;
                $productTotalPrice = $deliveredOrder->cart->quantity * $actualPrice;
                $totalRevenue = $totalRevenue + $productTotalPrice;
            }
            return view('admin.home', compact('totalProduct', 'totalOrder','totalCustomer','totalRevenue', 'deliveredOrdersCount', 'pendingOrders'));
        } else {
            $products = Product::all();
            return view('home.userpage', compact('products', 'userType'));
        }
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
