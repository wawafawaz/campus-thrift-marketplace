<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Report;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $pendingProducts = Product::where('status', 'Pending')->count();
        $approvedProducts = Product::where('status', 'Approved')->count();
        $soldProducts = Product::where('status', 'Sold')->count();
        $totalTransactions = Transaction::count();
        $totalReports = Report::where('status', 'Pending')->count();

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