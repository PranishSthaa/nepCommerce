<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function cartToOrder()
    {
        $user = Auth::user();
        $userId = $user->id;
        $carts = Cart::where('user_id', '=', $userId)->where('isOrdered', '=', 0)->get();
        if (count($carts) != 0) {
            foreach ($carts as $cart) {
                $order = new Order();
                $order->cart()->associate($cart);
                $order->user()->associate($user);
                $order->payment_status = 'cash';
                $order->delivery_status = 'pending';
                $order->save();

                $cart->isOrdered = 1;
                $cart->save();
            }
            return redirect()->back()->with('message', 'Order placed successfully. We will contact you soon!');
        } else {
            return redirect()->back()->with('message', 'Cart is empty. Please add products to cart.');
        }
    }

    public function deliver($id)
    {
        $order = Order::find($id);
        $order->delivery_status = 'delivered';
        $order->save();
        return redirect()->back()->with('message', 'Order delivered successfully.');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pendingOrders = Order::where('delivery_status', '=', 'pending')->with('cart.product', 'user')->get();
        $deliveredOrders = Order::where('delivery_status', '=', 'delivered')->with('cart.product', 'user')->get();

        return view('admin.order.index', compact('pendingOrders', 'deliveredOrders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);

        if ($order->delete()) {
            return redirect()->back()->with('message', 'Order deleted successfully.');
        } else {
            dd('fail');
        }
    }
}
