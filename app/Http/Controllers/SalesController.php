<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SalesController extends Controller
{
    public function index()
    {
        $title = 'Penjualan';
        $filePath = 'data/penjualan.txt';
        $sales = Storage::exists($filePath) ? json_decode(Storage::get($filePath), true) : [];

        $produkPath = 'data/produk.txt';
        $products = Storage::exists($produkPath) ? json_decode(Storage::get($produkPath), true) : [];

        usort($sales, function ($a, $b) {
            return $b['total_penjualan'] <=> $a['total_penjualan'];
        });
        return view('sales.index', compact('sales', 'products', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_transaksi' => 'required|date',
            'nama_produk' => 'required|string|max:255',
            'item_terjual' => 'required|integer|min:1',
        ]);

        $filePath = 'data/penjualan.txt';
        $penjualans = Storage::exists($filePath) ? json_decode(Storage::get($filePath), true) : [];

        $penjualans[] = [
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'nama_produk' => $request->nama_produk,
            'item_terjual' => (int) $request->item_terjual,
            'total_penjualan' => (int) $request->item_terjual * $request->harga_produk,
        ];

        Storage::put($filePath, json_encode($penjualans, JSON_PRETTY_PRINT));
        return redirect('/sales')->with('success', 'Data penjualan berhasil ditambahkan');
    }

    public function update(Request $request, $index)
    {
        $request->validate([
            'tanggal_transaksi' => 'required|date',
            'nama_produk' => 'required|string|max:255',
            'item_terjual' => 'required|integer|min:1',
        ]);

        $filePath = 'data/penjualan.txt';
        $penjualans = Storage::exists($filePath) ? json_decode(Storage::get($filePath), true) : [];

        if (!isset($penjualans[$index])) {
            abort(404, 'Data tidak ditemukan');
        }

        $penjualans[$index] = [
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'nama_produk' => $request->nama_produk,
            'item_terjual' => (int) $request->item_terjual,
            'total_penjualan' => (int) $request->item_terjual * $request->harga_produk,
        ];

        Storage::put($filePath, json_encode($penjualans, JSON_PRETTY_PRINT));
        return redirect('/sales')->with('success', 'Data penjualan berhasil diperbarui');
    }

    public function destroy($index)
    {
        $filePath = 'data/penjualan.txt';
        $penjualans = Storage::exists($filePath) ? json_decode(Storage::get($filePath), true) : [];

        if (!isset($penjualans[$index])) {
            abort(404, 'Data tidak ditemukan');
        }

        array_splice($penjualans, $index, 1);

        Storage::put($filePath, json_encode($penjualans, JSON_PRETTY_PRINT));
        return redirect('/sales')->with('success', 'Data penjualan berhasil dihapus');
    }
}
