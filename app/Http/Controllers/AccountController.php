<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\News;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Account::where('status', 1)->paginate(10);
        return view('admin.pages.account')->with('list', $list);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->input('key')) {
            $list = Account::where('status', 1)
                ->where(function ($query) use ($request) {
                    $query->where('username', 'LIKE', '%' . $request->input('key') . '%')
                        ->orWhere('password', 'LIKE', '%' . $request->input('key') . '%');
                })
                ->paginate(10);
            return view('admin.pages.account')->with('list', $list);
        }
        return redirect()->route('account.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $check = Validator::make($request->all(), [
            'username' => 'required|string|unique:account,username',
        ]);
        if ($check->fails()) {
            return response()->json('Username đã tồn tại.');
        }

        DB::table('account')->insert([
            'username' => $request->input('username'),
            'password' => $request->input('password')
        ]);
        return response()->json('Thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $list = Account::where('status', 1)->paginate(10);
        $account = Account::where('username', $id)->first();
        return view('admin.pages.account')
            ->with('account', $account)
            ->with('list', $list);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::table('account')->where('username', $id)->update([
            'password' => $request->input('password')
        ]);
        return redirect()->route('account.index')->with('message', 'Cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $client = new Client();
        $captcha = $request->input('idcaptcha');
        $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret' => '6LcNdGoqAAAAAMujOh6Jm3MZ3aM68kfiF1oq7zHI',
                'response' => $captcha,
                'remoteip' => $request->ip(),
            ]
        ]);
        $result = json_decode((string) $response->getBody());
        if ($result->success) {
            DB::table('account')->where('username', $id)->update([
                'status' => 0
            ]);
            DB::table('news')->where('author', $id)->update([
                'status' => 0
            ]);
            return response()->json('Khóa thành công.');
        }
    }
}
