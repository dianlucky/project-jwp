<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Kategori';
        $categories = Storage::exists('data/kategori.txt') ? json_decode(Storage::get('data/kategori.txt'), true) : [];
        return view('category.index', compact('categories', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = Storage::exists('data/kategori.txt') ? json_decode(Storage::get('data/kategori.txt'), true) : [];

        // Tambah data baru
        $data[] = [
            'nama_kategori' => $request->nama_kategori,
        ];

        Storage::put('data/kategori.txt', json_encode($data, JSON_PRETTY_PRINT));
        return redirect('/category')->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $index)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $filePath = 'data/kategori.txt';
        $categories = Storage::exists($filePath) ? json_decode(Storage::get($filePath), true) : [];

        if (!isset($categories[$index])) {
            abort(404, 'Data tidak ditemukan');
        }

        $categories[$index]['nama_kategori'] = $request->nama_kategori;

        Storage::put($filePath, json_encode($categories, JSON_PRETTY_PRINT));

        return redirect('/category')->with('success', 'Kategori berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($index)
    {
        $filePath = 'data/kategori.txt';
        $categories = Storage::exists($filePath) ? json_decode(Storage::get($filePath), true) : [];

        if (!isset($categories[$index])) {
            abort(404, 'Data tidak ditemukan');
        }

        array_splice($categories, $index, 1);

        Storage::put($filePath, json_encode($categories, JSON_PRETTY_PRINT));

        return redirect('/category')->with('success', 'Kategori berhasil dihapus');
    }
}
