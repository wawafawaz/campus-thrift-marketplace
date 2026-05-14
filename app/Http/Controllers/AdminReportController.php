<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Contract\Database;

class AdminReportController extends Controller
{
    protected $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function index()
    {
        $reports = $this->database
            ->getReference('reports')
            ->getValue();

        $reports = collect($reports ?? []);

        return view('admin.reports', compact('reports'));
    }

    public function resolve($id)
    {
        $this->database->getReference('reports/' . $id)->update([
            'status' => 'Resolved'
        ]);

        return redirect()->back()->with('success', 'Report resolved successfully.');
    }
}