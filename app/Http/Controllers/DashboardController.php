<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard / beranda
     */
    public function index(Request $request)
    {
        $title = 'Dashboard';

        // Ambil data dari file
        $sales = Storage::exists('data/penjualan.txt') ? json_decode(Storage::get('data/penjualan.txt'), true) : [];
        $products = Storage::exists('data/produk.txt') ? json_decode(Storage::get('data/produk.txt'), true) : [];
        $categories = Storage::exists('data/kategori.txt') ? json_decode(Storage::get('data/kategori.txt'), true) : [];

        // Menghitung total item terjual bulan ini
        $now = Carbon::now();
        $totalSoldItems = 0;

        // Buat array untuk menyimpan total penjualan per produk
        $productSalesMap = [];

        foreach ($sales as $sale) {
            $date = Carbon::parse($sale['tanggal_transaksi']);

            if ($date->isSameMonth($now)) {
                $totalSoldItems += (int) $sale['item_terjual'];

                $productName = $sale['nama_produk'];
                if (!isset($productSalesMap[$productName])) {
                    $productSalesMap[$productName] = 0;
                }
                $productSalesMap[$productName] += (int) $sale['item_terjual'];
            }
        }

        // Kelompokkan produk berdasarkan kategori
        $categoryProductMap = [];
        foreach ($products as $product) {
            $categoryName = $product['nama_kategori'];
            $productName = $product['nama_produk'];
            $categoryProductMap[$categoryName][] = $productName;
        }

        // Cari produk terlaris dari tiap kategori
        $topProductPerCategory = [];
        foreach ($categoryProductMap as $categoryName => $productList) {
            $topProduct = null;
            $maxSold = 0;

            foreach ($productList as $productName) {
                $sold = $productSalesMap[$productName] ?? 0;

                if ($sold > $maxSold) {
                    $maxSold = $sold;
                    $topProduct = $productName;
                }
            }

            $topProductPerCategory[$categoryName] = [
                'product' => $topProduct,
                'total_sold' => $maxSold,
            ];
        }

        // ========== CHART: Filter Berdasarkan Bulan Dipilih ==========
        $selectedMonth = $request->query('month', $now->format('Y-m'));
        $selectedMonthCarbon = Carbon::parse($selectedMonth . '-01');

        $monthlySales = [];
        foreach ($sales as $sale) {
            $date = Carbon::parse($sale['tanggal_transaksi']);
            if ($date->isSameMonth($selectedMonthCarbon)) {
                $productName = $sale['nama_produk'];
                if (!isset($monthlySales[$productName])) {
                    $monthlySales[$productName] = 0;
                }
                $monthlySales[$productName] += (int) $sale['item_terjual'];
            }
        }

        arsort($monthlySales);
        $chartLabels = array_keys($monthlySales);
        $chartData = array_values($monthlySales);
        // ========== END OF CHART: Filter Berdasarkan Bulan Dipilih ==========

        // ========== CHART: Produk Terlaris 6 Bulan Terakhir ==========
        $sixMonthsAgo = Carbon::now()->subMonths(5)->startOfMonth();
        $nowEnd = Carbon::now()->endOfMonth();

        $salesLast6Months = [];
        foreach ($sales as $sale) {
            $date = Carbon::parse($sale['tanggal_transaksi']);
            if ($date->between($sixMonthsAgo, $nowEnd)) {
                $productName = $sale['nama_produk'];
                if (!isset($salesLast6Months[$productName])) {
                    $salesLast6Months[$productName] = 0;
                }
                $salesLast6Months[$productName] += (int) $sale['item_terjual'];
            }
        }

        arsort($salesLast6Months);
        $chartLabels6Months = array_keys($salesLast6Months);
        $chartData6Months = array_values($salesLast6Months);
        // ========== END OF CHART: Produk Terlaris 6 Bulan Terakhir ==========

        // ========== TABEL: Penjualan dan Status Produk ==========
        $productRevenueStatus = [];

        foreach ($sales as $sale) {
            $productName = $sale['nama_produk'];
            $totalPenjualan = (int) $sale['total_penjualan'];

            if (!isset($productRevenueStatus[$productName])) {
                $productRevenueStatus[$productName] = 0;
            }

            $productRevenueStatus[$productName] += $totalPenjualan;
        }

        $productStatusList = [];

        foreach ($productRevenueStatus as $productName => $totalPenjualan) {
            // Tentukan status berdasarkan total penjualan
            if ($totalPenjualan >= 100_000_000) {
                $status = 'Tinggi';
            } elseif ($totalPenjualan >= 50_000_000) {
                $status = 'Sedang';
            } elseif ($totalPenjualan >= 20_000_000) {
                $status = 'Cukup';
            } elseif ($totalPenjualan >= 10_000_000) {
                $status = 'Rendah';
            } else {
                $status = 'Sangat Rendah';
            }

            $productStatusList[] = [
                'nama_produk' => $productName,
                'total_penjualan' => $totalPenjualan,
                'status' => $status,
            ];
            usort($productStatusList, function ($a, $b) {
                return $b['total_penjualan'] <=> $a['total_penjualan'];
            });
        }
        // ========== END OF TABEL: Penjualan dan Status Produk ==========
        

        // ========== CHART: Total Penjualan per Bulan 6 Bulan Terakhir ==========
        $monthlyTotalSales = [];
        $now = Carbon::now();

        for ($i = 5; $i >= 0; $i--) {
            $month = $now->copy()->subMonths($i);
            $label = $month->format('F Y'); // Contoh: "Maret 2025"
            $monthlyTotalSales[$label] = 0;
        }

        foreach ($sales as $sale) {
            $date = Carbon::parse($sale['tanggal_transaksi']);
            $label = $date->format('F Y');

            if (array_key_exists($label, $monthlyTotalSales)) {
                $monthlyTotalSales[$label] += (int) $sale['total_penjualan'];
            }
        }

        $labels6MonthsBars = array_keys($monthlyTotalSales);
        $data6MonthsBars = array_values($monthlyTotalSales);
        // ==========  END OF CHART: Total Penjualan per Bulan 6 Bulan Terakhir ==========


        return view(
            'index',
            compact(
               'title',
                'totalSoldItems',
                'topProductPerCategory',
                'chartLabels',
                'chartData',
                'selectedMonth',
                'chartLabels6Months',
                'chartData6Months',
                'productStatusList',
                'labels6MonthsBars', 
                'data6MonthsBars',
            ),
        );
    }
}
