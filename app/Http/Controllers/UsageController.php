<?php

namespace App\Http\Controllers;

use App\Models\Usage;
use App\Models\User;
use Illuminate\Http\Request;

class UsageController extends Controller
{
    /**
     * Store a usage record.
     *
     * The client only sends `password`. The `name` is copied from the
     * admin's stored wifiname (single-admin system: the most recently
     * updated user row), and `created_at` is set automatically.
     */
    public function store(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        $admin = User::latest('updated_at')->first();

        if (!$admin || empty($admin->wifiname)) {
            return response()->json([
                'success' => false,
                'message' => 'Wifi name is not set yet.',
            ], 422);
        }

        $usage = Usage::create([
            'name' => $admin->wifiname,
            'password' => $request->password,
        ]);

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $usage->id,
                'name' => $usage->name,
                'password' => $usage->password,
                'created_at' => $usage->created_at,
            ],
        ], 201);
    }
}
