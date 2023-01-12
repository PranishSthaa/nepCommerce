<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userType = (Auth::user()) ? Auth::user()->user_type : 0;
        $userId = Auth::user()->id;
        $carts = Cart::where('user_id', '=', $userId)->where('isOrdered', '=', 0)->with('user', 'product')->get();

        return view('home.cart', compact('userType', 'carts'));
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
    public function store(Request $request, $id)
    {
        if (Auth::id()) {
            $cart = new Cart();
            $user = Auth::user();
            $product = Product::find($id);
            $cart->quantity = ($request->quantity) ? $request->quantity : 1;
            $cart->isOrdered = 0;
            $cart->user()->associate($user);
            $cart->product()->associate($product);
            $cart->save();
            return redirect()->back();
        } else {
            return redirect('login');
        }
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
        $cart = Cart::find($id);
        if ($cart->delete()) {
            return redirect()->back()->with('message', 'Product removed from cart successfully.');
        } else {
            dd('fail');
        }
    }
}
