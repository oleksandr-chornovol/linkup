<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::find($id);
        return view('product.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('product.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'brand' => 'required|max:255',
            'price' => 'numeric',
            'docket' => 'required|max:1000'
        ]);

        if (!$validator->fails()) {
            Product::find($id)->update($request->all());
            return redirect("product/{$id}")->with('message', 'Product successfully updated!');
        } else {
            return redirect("product/{$id}/edit")
                ->withErrors($validator)
                ->withInput();
        }
    }

    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect()->back()->with('message', 'Product deleted successfully!');
    }
}
