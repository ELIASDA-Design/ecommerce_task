<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class ProductsController extends Controller
{
    public function show() {
        $products = Product::all();
        return view('products.show', compact('products'));
    }

    public function showAddPage() {
        return view('products.add');
    }

    public function create(Request $request) {
        $product = new Product();

        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->stock_quantity = $request->input('quantity');

        try {
            $product->save();
            return redirect('/admin/dashboard/products');
        } catch(Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function showEditPage($id) {
        $product = Product::where('id', $id)->first();

        return view('products.edit', compact('product'));
    }

    public function edit(Request $request) {

        try {
            DB::table("products")->where('id',$request->id)->update(array(
                "name" => $request->name,
                "price" => $request->price,
                "stock_quantity" => $request->quantity,
            ));
            return redirect('/admin/dashboard/products');
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function delete(Request $request) {
        $product = Product::where('id', $request->id)->first();

        try {
            $product->delete();
            return redirect('/admin/dashboard/products');
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
