<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Contract\Database;

class AdminController extends Controller
{
    protected $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function dashboard()
    {
        $users = collect($this->database->getReference('users')->getValue() ?? []);
        $products = collect($this->database->getReference('products')->getValue() ?? []);
        $transactions = collect($this->database->getReference('transactions')->getValue() ?? []);
        $reports = collect($this->database->getReference('reports')->getValue() ?? []);

        $totalUsers = $users->count();
        $totalProducts = $products->count();

        $pendingProducts = $products->where('status', 'Pending')->count();

        $approvedProducts = $products->filter(function ($product) {
            return strtolower($product['status'] ?? '') === 'approved';
        })->count();

        $soldProducts = $products->filter(function ($product) {
            return strtolower($product['status'] ?? '') === 'sold';
        })->count();

        $totalTransactions = $transactions->count();

        $totalReports = $reports->filter(function ($report) {
            return strtolower($report['status'] ?? '') === 'pending';
        })->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalProducts',
            'pendingProducts',
            'approvedProducts',
            'soldProducts',
            'totalTransactions',
            'totalReports'
        ));
    }
}