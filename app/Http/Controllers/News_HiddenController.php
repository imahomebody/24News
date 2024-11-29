<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class News_HiddenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = News::where('status', 0)->paginate(5);
        return view('admin.pages.news_hidden')->with('list', $list);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->input('key')) {
            $list = News::where('status', 0)
                ->where(function ($query) use ($request) {
                    $query->where('title', 'LIKE', '%' . $request->input('key') . '%')
                        ->orWhere('content', 'LIKE', '%' . $request->input('key') . '%');
                })
                ->paginate(5);
            return view('admin.pages.news_hidden')->with('list', $list);
        }
        return redirect()->route('hidden_news.index');
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
        $account = News::whereIn('author', Account::where('status', 0)->pluck('username'))->where('id', $id)->first();
        if ($account)
            return response()->json('Không thể khôi phục vì tài khoản ' . $account->author . ' đã bị khóa.');
        $category = News::whereIn('category', Category::where('status', 0)->pluck('id'))->where('id', $id)->first();
        if ($category)
            return response()->json('Không thể khôi phục vì phân loại ' . Category::find($category->category)->name . ' đã bị ẩn.');
        News::where('id', $id)->update([
            'status' => 1
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
            News::where('id', $id)->delete();
            return response()->json('Xóa thành công');
        }
    }
}
