<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Contact::paginate(10);
        return view('admin.pages.contact')->with('list', $list);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->input('key')) {
            $list = Contact::
                where('name', 'LIKE', '%' . $request->input('key') . '%')
                ->orWhere('email', 'LIKE', '%' . $request->input('key') . '%')
                ->orWhere('subject', 'LIKE', '%' . $request->input('key') . '%')
                ->orWhere('message', 'LIKE', '%' . $request->input('key') . '%')
                ->paginate(10);
            return view('admin.pages.contact')->with('list', $list);
        }
        return redirect()->route('contact.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $check = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($check->fails()) {
            return response()->json('Không đúng định dạng @email.');
        }

        DB::table('contact')->insert([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message')
        ]);
        return response()->json('Liên hệ thành công.');
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
        //
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
            Contact::find($id)->delete();
            return response()->json('Xóa thành công');
        }
    }
}
