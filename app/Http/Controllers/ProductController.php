<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::get();

        // if ($request->ajax()) {

        //     $product = Product::where('id', 'like', '%' . $request->search . '%')
        //         ->orwhere('item_code', 'like', '%' . $request->search . '%')
        //         ->orwhere('productname', 'like', '%' . $request->search . '%')
        //         ->orwhere('category', 'like', '%' . $request->search . '%')->get();
        // }

        return view('product.index', ['data' => $product]);
    }

    public function add()
    {
        $category = category::get();

        return view('product.form', ['category' => $category]);
    }

    public function save(Request $request)
    {
        $data = [
            'item_code' => $request->item_code,
            'productname' => $request->productname,
            'category' => $request->id_category,
            'price' => $request->price
        ];

        Product::create($data);

        return redirect()->route('product');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $category = category::get();

        return view('product.form', ['product' => $product, 'category' => $category]);
    }

    public function update($id, Request $request)
    {
        $data = [
            'item_code' => $request->item_code,
            'productname' => $request->productname,
            'category' => $request->id_category,
            'price' => $request->price
        ];

        Product::find($id)->update($data);

        return redirect()->route('product');
    }

    public function delete($id)
    {
        Product::find($id)->delete();

        return redirect()->route('product');
    }
}
