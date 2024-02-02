<?php

namespace App\Http\Controllers\Api;

use App\Models\HasilPertandingan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;

class HasilPertandinganController extends Controller
{
    public function index()
    {
        //get posts
        $hasilPertandingan = HasilPertandingan::all();

        //return collection of posts as a resource
        return new PostResource(true, 'List Hasil Pertandingan', $hasilPertandingan);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'klub_tuan_rumah_id'     => 'required',
            'klub_tamu_id'     => 'required',
            'skor_tuan_rumah'     => 'required',
            'skor_tamu'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $post = HasilPertandingan::create([
            'klub_tuan_rumah_id'     => $request->klub_tuan_rumah_id,
            'klub_tamu_id'   => $request->klub_tamu_id,
            'skor_tuan_rumah'   => $request->skor_tuan_rumah,
            'skor_tamu'   => $request->skor_tamu,
        ]);

        //return response
        return new PostResource(true, 'Data Pertandingan Berhasil Ditambahkan!', $post);
    }
}
