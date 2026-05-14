<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;

class AdminProductController extends Controller
{
    protected $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function index(Request $request)
    {
        $status = $request->query('status');

        $products = $this->database
            ->getReference('products')
            ->getValue();

        $products = collect($products ?? []);

        if ($status) {
            $products = $products->filter(function ($product) use ($status) {
                return isset($product['status']) && $product['status'] == $status;
            });
        }

        return view('admin.products', compact('products', 'status'));
    }

    public function store(Request $request)
    {
        $newProduct = [
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'condition' => $request->condition,
            'description' => $request->description,
            'status' => 'Approved',
            'created_by' => 'Admin',
            'created_at' => now()->toDateTimeString(),
        ];

        $this->database
            ->getReference('products')
            ->push($newProduct);

        return redirect()->back()->with('success', 'Product added successfully.');
    }

    public function approve($id)
    {
        $this->database->getReference('products/' . $id)->update([
            'status' => 'Approved'
        ]);

        return redirect()->back()->with('success', 'Product approved successfully.');
    }

    public function reject($id)
    {
        $this->database->getReference('products/' . $id)->update([
            'status' => 'Rejected'
        ]);

        return redirect()->back()->with('success', 'Product rejected successfully.');
    }

    public function destroy($id)
    {
        $this->database->getReference('products/' . $id)->remove();

        return redirect()->back()->with('success', 'Product removed successfully.');
    }
}