<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Http\Controllers\ProductCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::all();
            return view('categories.index',['categories'=>$categories]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {       
  

     $request_data = $request->all();
   
    Category::create($request_data);

    return to_route("categories.index");
    
    }
  
        //
    public function show(Category $category)
    {
        return view('categories.show', ['category'=>$category]);
    }
   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
        return view('categories.edit', ['category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //   
        $category->update($request->all());
        return to_route('categories.show', $category->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return to_route('categories.index');
    }
}
