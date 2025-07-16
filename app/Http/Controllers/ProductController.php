<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $title = 'Produk';
        $products = Storage::exists('data/produk.txt') ? json_decode(Storage::get('data/produk.txt'), true) : [];
        $categories = Storage::exists('data/kategori.txt') ? json_decode(Storage::get('data/kategori.txt'), true) : [];
        return view('product.index', compact('products', 'categories', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'nama_kategori' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        $products = Storage::exists('data/produk.txt') ? json_decode(Storage::get('data/produk.txt'), true) : [];

        $products[] = [
            'nama_produk' => $request->nama_produk,
            'nama_kategori' => $request->nama_kategori,
            'harga' => (int) $request->harga,
        ];

        Storage::put('data/produk.txt', json_encode($products, JSON_PRETTY_PRINT));

        return redirect('/product')->with('success', 'Produk berhasil ditambahkan');
    }

    public function update(Request $request, $index)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'nama_kategori' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        $products = Storage::exists('data/produk.txt') ? json_decode(Storage::get('data/produk.txt'), true) : [];

        if (!isset($products[$index])) {
            abort(404, 'Data tidak ditemukan');
        }

        $products[$index]['nama_produk'] = $request->nama_produk;
        $products[$index]['nama_kategori'] = $request->nama_kategori;
        $products[$index]['harga'] = (int) $request->harga;

        Storage::put('data/produk.txt', json_encode($products, JSON_PRETTY_PRINT));

        return redirect('/product')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($index)
    {
        $products = Storage::exists('data/produk.txt') ? json_decode(Storage::get('data/produk.txt'), true) : [];

        if (!isset($products[$index])) {
            abort(404, 'Data tidak ditemukan');
        }

        array_splice($products, $index, 1);

        Storage::put('data/produk.txt', json_encode($products, JSON_PRETTY_PRINT));

        return redirect('/product')->with('success', 'Produk berhasil dihapus');
    }
}
