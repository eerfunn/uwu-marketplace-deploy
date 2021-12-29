<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
 
    /*
    Show Application Dashboard
    *@return \Illuminate\Contracts\Support\Renderable
    */

    public function index(){
        $categories = Category::get();
        $products = Product::with(['galleries'])->paginate(4);
        return view('pages.category', 
        ['categories' => $categories,
        'products' => $products]);
    }
    public function detail(Request $request, $slug){
        $categories = Category::all();
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::with(['galleries'])->where('categories_id', $category->id)->paginate(4);
        return view('pages.category',
        ['categories' => $categories,
        'products' => $products]);
    }
}
