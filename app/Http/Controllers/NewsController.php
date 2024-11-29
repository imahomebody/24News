<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use GuzzleHttp\Client;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = News::where('status', 1)->paginate(5);
        return view('admin.pages.news')->with('list', $list);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->input('key')) {
            $list = News::where('status', 1)
                ->where(function ($query) use ($request) {
                    $query->where('title', 'LIKE', '%' . $request->input('key') . '%')
                        ->orWhere('content', 'LIKE', '%' . $request->input('key') . '%');
                })
                ->paginate(5);
            return view('admin.pages.news')->with('list', $list);
        }
        return redirect()->route('news.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fileName = 'news_' . time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $fileName);
        $news = new News();
        $news->image = $fileName;
        $news->title = $request->input('title');
        $news->content = $request->input('content');
        $news->category = $request->input('category');
        $news->author = $request->input('author');
        $news->slug = Str::slug($news->title);
        $news->save();
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
    public function edit(string $slug)
    {
        $list = News::where('status', 1)->paginate(5);
        $news = News::where('slug', $slug)->first();
        return view('admin.pages.news')
            ->with('news', $news)
            ->with('list', $list);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $news = News::find($id);
        if ($request->hasFile('image')) {
            $fileName = 'news_' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $fileName);
            $news->image = $fileName;
        }
        $news->title = $request->input('title');
        $news->content = $request->input('content');
        $news->category = $request->input('category');
        $news->author = $request->input('author');
        $news->modified = \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
        $news->slug = Str::slug($news->title);
        $news->save();
        return redirect()->route('news.index')->with('message', 'Cập nhật thành công.');
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
            News::where('id', $id)->update([
                'status' => 0
            ]);
            return response()->json('Ẩn thành công.');
        }

    }
}
