<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product;
        $category = Category::find($request->category);

        $product->title = $request->title;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->category()->associate($category);

        $image = $request->product_image;
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $product->image = $imageName;

        if ($product->save()) {
            $request->product_image->move('product', $imageName);
        };

        return redirect()->route('productsIndex')->with('message', 'Product added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userType = (Auth::user()) ? Auth::user()->user_type : 0;
        $product = Product::find($id);
        $categoryId = $product->category_id;
        $categorizedProducts = Product::where('category_id', $categoryId)->get();
        return view('home.productDetail', compact('product', 'categorizedProducts', 'userType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
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
        $product = Product::find($id);
        $category = Category::find($request->category);

        $product->title = $request->title;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->category()->associate($category);

        $image = $request->product_image;
        if ($image) {
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $product->image = $imageName;
            $request->product_image->move('product', $imageName);
        }
        $product->save();

        return redirect()->route('productsIndex')->with('message', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if ($product->delete()) {
            return redirect()->back()->with('message', 'Product deleted successfully.');
        } else {
            dd('fail');
        }
    }
}
