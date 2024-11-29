<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Category;
use App\Models\News;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class Category_HiddenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Category::where('status', 0)->paginate(10);
        return view('admin.pages.category_hidden')->with('list', $list);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->input('key')) {
            $list = Category::where('status', 0)
                ->where(function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%' . $request->input('key') . '%');
                })
                ->paginate(10);
            return view('admin.pages.category_hidden')->with('list', $list);
        }
        return redirect()->route('hidden_category.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        DB::table('category')->where('id', $id)->update([
            'status' => 1
        ]);
        DB::table('news')->where('category', $id)->update([
            'status' => 1
        ]);
        $account = Account::where('status', 0)->pluck('username');
        DB::table('news')->whereIn('author', $account)->update([
            'status' => 0
        ]);
        return response()->json('Khôi phục thành công');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
            News::where('category', $id)->delete();
            Category::where('id', $id)->delete();
            return response()->json('Xóa thành công');
        }
    }
}
