<?php

namespace App\Http\Controllers\Api;

use App\Models\Buku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new PostResource(Buku::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'isbn' => 'required',
            'jumlah_halaman' => 'required',
            'kategori' => 'required',
            'sinopsis' => 'required',
            'cover_buku' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required',
            'lokasi_rak' => 'required',
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $coverPath = $request->file('cover_buku')->store('cover_buku', 'public');

        $buku = Buku::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'isbn' => $request->isbn,
            'jumlah_halaman' => $request->jumlah_halaman,
            'kategori' => $request->kategori,
            'sinopsis' => $request->sinopsis,
            'cover_buku' => $coverPath,
            'status' => $request->status,
            'lokasi_rak' => $request->lokasi_rak
        ]);

        // Tambahkan URL untuk cover buku
        $buku->cover_buku_url = Storage::url($coverPath);

        return new PostResource($buku);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $buku = Buku::findOrFail($id);

        // Tambahkan URL untuk cover buku
        if ($buku->cover_buku) {
            $buku->cover_buku_url = Storage::url($buku->cover_buku);
        }

        return response()->json([
            'success' => true,
            'data' => $buku
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buku $buku)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'isbn' => 'required',
            'jumlah_halaman' => 'required',
            'kategori' => 'required',
            'sinopsis' => 'required',
            'cover_buku' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required',
            'lokasi_rak' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }

        if ($request->hasFile('cover_buku')) {
            // Hapus file lama jika ada
            if ($buku->cover_buku) {
                Storage::disk('public')->delete($buku->cover_buku);
            }

            // Simpan file baru di disk 'public'
            $coverPath = $request->file('cover_buku')->store('cover_buku', 'public');
        } else {
            $coverPath = $buku->cover_buku;
        }

        $buku->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'isbn' => $request->isbn,
            'jumlah_halaman' => $request->jumlah_halaman,
            'kategori' => $request->kategori,
            'sinopsis' => $request->sinopsis,
            'cover_buku' => $coverPath,
            'status' => $request->status,
            'lokasi_rak' => $request->lokasi_rak
        ]);

        // Tambahkan URL untuk cover buku
        $buku->cover_buku_url = Storage::url($coverPath);

        return response()->json([
            'success' => true,
            'message' => 'Data buku berhasil diupdate!',
            'data' => $buku
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buku $buku)
    {
        $buku->delete();
        return new PostResource($buku);
    }
}
