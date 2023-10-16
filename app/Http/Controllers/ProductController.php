<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function  create(){
    
        $category=Category::all();
        return view('products.create',["category" =>$category]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $request_data = $request->all();
        if ($request->file('image') != []) {
            $image_path = $request->file('image')->store('products_images', 'uploads');
            $request_data['image'] = $image_path;
        }
        Product::create($request_data);
        return to_route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $request_data = $request->all();
        if ($request->file('image') != []) {
            $image_path = $request->file('image')->store('products_images', 'uploads');
            $request_data['image'] = $image_path;
        }
        $product->update($request_data);
        return to_route('products.show', $product->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        Storage::disk('uploads')->delete($product->image);
        return to_route('products.index');
    }
}
