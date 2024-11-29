<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use GuzzleHttp\Client;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Category::where('status', 1)->paginate(10);
        return view('admin.pages.category')->with('list', $list);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->input('key')) {
            $list = Category::where('status', 1)
                ->where(function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%' . $request->input('key') . '%');
                })
                ->paginate(10);
            return view('admin.pages.category')->with('list', $list);
        }
        return redirect()->route('category.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $check = Validator::make($request->all(), [
            'name' => 'required|string|unique:category,name',
        ]);
        if ($check->fails()) {
            return response()->json('Phân loại đã tồn tại.');
        }

        $category = new Category();
        $category->name = $request->input('name');
        $category->slug = Str::slug($category->name);
        $category->save();
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
        $list = Category::where('status', 1)->paginate(10);
        $category = Category::where('slug', $slug)->first();
        return view('admin.pages.category')
            ->with('category', $category)
            ->with('list', $list);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->slug = Str::slug($category->name);
        $category->save();
        return redirect()->route('category.index')->with('message', 'Cập nhật thành công.');
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
            DB::table('category')->where('id', $id)->update([
                'status' => 0
            ]);
            DB::table('news')->where('category', $id)->update([
                'status' => 0
            ]);
            return response()->json('Ẩn thành công');
        }
    }
}
