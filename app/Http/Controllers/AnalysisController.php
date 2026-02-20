<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SimulationResult;

class AnalysisController extends Controller
{
    public function dashboard(Request $request)
    {
        // ==============================================================
        // 1. DATA STATISTIK UTAMA (Selalu menampilkan data keseluruhan)
        // ==============================================================
        $allData = SimulationResult::all();

        $totalPeserta = $allData->count();
        $rataRata = $allData->avg('score') ?? 0;
        $nilaiTertinggi = $allData->max('score') ?? 0;
        $nilaiTerendah = $allData->min('score') ?? 0;

        $top5 = SimulationResult::orderByDesc('score')
                ->take(5)
                ->get();

        $distribusi = [
            '85-100' => SimulationResult::whereBetween('score', [85, 100])->count(),
            '70-84'  => SimulationResult::whereBetween('score', [70, 84])->count(),
            '55-69'  => SimulationResult::whereBetween('score', [55, 69])->count(),
            '<55'    => SimulationResult::where('score', '<', 55)->count(),
        ];

        // ==============================================================
        // 2. DATA UNTUK TABEL (Merespon fitur Pencarian & Filter)
        // ==============================================================
        $query = SimulationResult::query();

        // Ambil parameter dari form UI
        $search = $request->input('search');
        $kategori = $request->input('kategori');

        // Logika Pencarian berdasarkan Nama atau Absen
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('absen', 'like', "%{$search}%");
            });
        }

        // Logika Filter Kategori Nilai
        if ($kategori) {
            if ($kategori == 'sangat_baik') {
                $query->where('score', '>=', 85);
            } elseif ($kategori == 'baik') {
                $query->whereBetween('score', [70, 84]);
            } elseif ($kategori == 'cukup') {
                $query->whereBetween('score', [55, 69]);
            } elseif ($kategori == 'perlu_latihan') {
                $query->where('score', '<', 55);
            }
        }

        // Ambil data tabel yang sudah terfilter, urutkan dari yang terbaru
        $semuaData = $query->latest()->get();

        // ==============================================================
        // 3. KIRIM KE VIEW
        // ==============================================================
        return view('admin.analisis.dashboard', compact(
            'semuaData',
            'totalPeserta',
            'rataRata',
            'nilaiTertinggi',
            'nilaiTerendah',
            'top5',
            'distribusi'
        ));
    }
}