<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\View\view;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function login_view()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        if (!$username) {
            return redirect()->back()->with('error', 'Invalid username.');
        }

        if (!$password) {
            return redirect()->back()->with('error', 'Invalid password.');
        }

        $account = Account::where('username', $username)->first();

        if (!$account) {
            return redirect()->back()->with('error', 'Account not found.');
        }

        if ($account->password == $password) {
            return redirect()->route('admin_index');
        } else {
            return redirect()->back()->with('error', 'Wrong password.');
        }
    }

    public function index(): view
    {
        return view('admin.pages.index');
    }
}