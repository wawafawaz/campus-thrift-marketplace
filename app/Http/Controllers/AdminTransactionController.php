<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Contract\Database;

class AdminTransactionController extends Controller
{
    protected $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function index()
    {
        $transactions = $this->database
            ->getReference('transactions')
            ->getValue();

        $transactions = collect($transactions ?? []);

        return view('admin.transactions', compact('transactions'));
    }
}