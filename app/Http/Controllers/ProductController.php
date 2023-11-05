<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Request;
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
        return Inertia::render('Products/Index', [
            'filters' => Request::all('search'),
            'products' => Product::select('*')
            ->orderByDesc('created_at')
            ->filter(Request::only('search'))
            ->paginate(5)
            ->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Products/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Request::merge([
            'uuid' => Str::uuid()->toString(),
            'user_id' => Auth::user()->id
        ]);
        
        Request::validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock_status' => 'required|in:inStock,outOfStock',
            'total_stock' => 'numeric',
        ]);
        // dd(Request::only('uuid', 'name', 'price', 'iamge', 'description', 'user_id'));
        // $product = Request::only('uuid', 'name', 'price', 'image', 'description', 'user_id');
        $product = Product::create(Request::only('uuid', 'name', 'price', 'image', 'description', 'user_id', 'stock_status', 'total_stock'));

        return redirect()
            ->route('products.index')
            ->with('success', 'Product "'. $product->name . ' "created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return Inertia::render('Products/Edit', [
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validated = Request::validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock_status' => 'required|in:inStock,outOfStock',
            'total_stock' => 'numeric',
        ]);

        $product->update(Request::only('name', 'price', 'image', 'description', 'stock_status', 'total_stock'));

        return redirect()
            ->route('products.index')
            ->with('success', 'Product "'. $product->name . ' "updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('error', 'Product "'. $product->name . ' "deleted');
    }
}
