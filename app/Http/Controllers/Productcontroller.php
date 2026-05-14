<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');

        if ($status) {
            $products = Product::where('status', $status)->get();
        } else {
            $products = Product::all();
        }

        return view('admin.products', compact('products', 'status'));
    }

    public function store(Request $request)
    {
        Product::create($request->only([
            'name',
            'category',
            'price',
            'condition',
            'description'
        ]));

        return redirect('/products')->with('success', 'Product added successfully.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.edit-product', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update($request->only([
            'name',
            'category',
            'price',
            'condition',
            'description'
        ]));

        return redirect('/products')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect('/products')->with('success', 'Product deleted successfully.');
    }

    public function approve($id)
    {
        $product = Product::findOrFail($id);
        $product->status = 'Approved';
        $product->save();

        return redirect('/products')->with('success', 'Product approved successfully.');
    }

    public function reject($id)
    {
        $product = Product::findOrFail($id);
        $product->status = 'Rejected';
        $product->save();

        return redirect('/products')->with('success', 'Product rejected successfully.');
    }

    public function markAsSold($id)
    {
        $product = Product::findOrFail($id);
        $product->status = 'Sold';
        $product->save();

        return redirect('/products')->with('success', 'Product marked as sold.');
    }
}