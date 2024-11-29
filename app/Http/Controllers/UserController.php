<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $list = News::where('status', 1)->paginate(4);
        return view('user.pages.index')->with('list', $list);
    }
    public function show($slug)
    {
        DB::update('UPDATE news SET view = view + 1 WHERE slug = "' . $slug . '"');
        $news = News::where('slug', $slug)->first();
        return view('user.pages.single')->with('news', $news);
    }
    public function category_search($slug)
    {
        $list = News::where('status', 1)->where('category', Category::where('slug', $slug)->first()->id)->paginate(4);
        return view('user.pages.search')->with('list', $list);
    }
    public function keyword_search(Request $request)
    {
        if ($request->input('key'))
            return redirect()->route('search', $request->input('key'));
        return redirect()->route('search', ' ');
    }
    public function search($key)
    {
        $list = News::where('status', 1)
            ->where('title', 'LIKE', '%' . $key . '%')
            ->orWhere('content', 'LIKE', '%' . $key . '%')
            ->paginate(4);
        return view('user.pages.search')->with('list', $list);
    }
    public function contact()
    {
        return view('user.pages.contact');
    }
}
