<?php

namespace App\Http\Controllers;

use App\Models\Usage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function show()
    {
        return view('login');
    }

    public function checklogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Session()->put('admindata', $user);
            return redirect()->route('dashboard');
        } elseif ($user) {
            return redirect('/login')->with('error', 'Password Incorrect');
        } else {
            return redirect('/login')->with('error', 'User Not Found');
        }
    }

    public function dashboard()
    {
        return view('index');
    }

    /**
     * Show the wifi name form and the list of usage records.
     */
    public function wifishow()
    {
        $admin = User::find(Session('admindata')->id);
        $usages = Usage::latest()->get();

        return view('wifi', [
            'admin' => $admin,
            'usages' => $usages,
        ]);
    }

    /**
     * Save the wifi name onto the logged-in admin's user row.
     */
    public function wifisave(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $admin = User::find(Session('admindata')->id);
        $admin->wifiname = $request->name;
        $admin->save();

        // Refresh the session copy so it stays in sync.
        Session()->put('admindata', $admin);

        return redirect()->route('wifishow')->with('success', 'Wifi name saved successfully');
    }

    /**
     * Delete a usage record.
     */
    public function usagedelete(Usage $usage)
    {
        $usage->delete();

        return redirect()->route('wifishow')->with('success', 'Usage deleted successfully');
    }
}
