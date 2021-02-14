<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Request $request, $rozetkaId)
    {
        $products = Category::whereRozetkaId($rozetkaId)->first()->products()->paginate(15);
        $view = $request->ajax() ? 'product.grid' : 'category.show';
        return view($view, compact('products'));
    }
}
