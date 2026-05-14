<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Contract\Database;

class AdminUserController extends Controller
{
    protected $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function index()
    {
        $users = $this->database
            ->getReference('users')
            ->getValue();

        $users = collect($users ?? []);

        return view('admin.users', compact('users'));
    }

    public function setActive($id)
    {
        $this->database->getReference('users/' . $id)->update([
            'status' => 'Active',
            'restriction_reason' => null,
            'restricted_until' => null,
            'updated_at' => now()->toDateTimeString()
        ]);

        return redirect()->back()->with('success', 'User account has been set to Active.');
    }

    public function restrict($id)
    {
        $this->database->getReference('users/' . $id)->update([
            'status' => 'Restricted',
            'restriction_reason' => 'Violation of marketplace rules',
            'restricted_until' => now()->addMonths(2)->toDateString(),
            'updated_at' => now()->toDateTimeString()
        ]);

        return redirect()->back()->with('success', 'User account has been restricted for 2 months.');
    }

    public function ban($id)
    {
        $this->database->getReference('users/' . $id)->update([
            'status' => 'Banned',
            'restriction_reason' => 'Serious or repeated violation of marketplace rules',
            'restricted_until' => 'Permanent',
            'updated_at' => now()->toDateTimeString()
        ]);

        return redirect()->back()->with('success', 'User account has been banned.');
    }
}