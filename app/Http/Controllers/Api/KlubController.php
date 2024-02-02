<?php

namespace App\Http\Controllers\Api;

use App\Models\Klub;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;

class KlubController extends Controller
{
    public function index()
    {
        //get posts
        $klasemen = Klub::all();

        //return collection of posts as a resource
        return new PostResource(true, 'List Data Klub', $klasemen);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama'     => 'required',
            'kota'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $post = Klub::create([
            'nama'     => $request->nama,
            'kota'   => $request->kota,
        ]);

        //return response
        return new PostResource(true, 'Data Klub Berhasil Ditambahkan!', $post);
    }
}
