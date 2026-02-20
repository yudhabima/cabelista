<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Material;
use App\Models\SimulationResult;


class CableController extends Controller
{
    /**
     * Urutan standar untuk validasi (T568A & T568B)
     */
    private array $T568A = [
        'white-green', 'green', 'white-orange', 'blue', 'white-blue', 'orange', 'white-brown', 'brown'
    ];

    private array $T568B = [
        'white-orange', 'orange', 'white-green', 'blue', 'white-blue', 'green', 'white-brown', 'brown'
    ];

    public function index(Request $request)
    {
        // --- LOGIKA GAME KABEL (YANG LAMA) ---
        // default urutan awal (acak)
        $wires = $this->T568B; 
        shuffle($wires);

        // --- LOGIKA VIDEO (YANG BARU) ---
        // 2. Ambil data video dari database
        $videoData = Video::first();

        // 3. Cek apakah ada data video custom? Jika tidak, pakai default.
        $videoUrl = $videoData ? $videoData->url : 'https://www.youtube.com/embed/5FBGJARktZQ';

        // 4. Kirim kedua data (wires & videoUrl) ke view
        // Pastikan nama view-nya sesuai dengan file landing page kamu (misal: 'welcome' atau 'cable.index')
        $materials = Material::latest()->get();

    return view('cable.index', compact('materials') + [

    'wires' => $wires,
    'videoUrl' => $videoUrl,
    'material' => Material::with('steps')->first()

]);
    }
    public function shuffle(Request $request)
    {
        $wires = $this->T568B;
        shuffle($wires);
        return response()->json(['wires' => $wires]);
    }

    public function check(Request $request)
    {
        $request->validate([
            'wires' => 'required|array|size:8',
            'wires.*' => 'string'
        ]);

        $wires = $request->input('wires');

        $isA = $wires === $this->T568A;
        $isB = $wires === $this->T568B;

        if ($isA || $isB) {
            return response()->json([
                'ok' => true,
                'scheme' => $isA ? 'T568A' : 'T568B'
            ]);
        }

        // Hitung berapa yang sudah benar pada posisi yang tepat (scoring sederhana)
        $scoreA = 0; $scoreB = 0;
        foreach ($wires as $i => $w) {
            if ($w === $this->T568A[$i]) $scoreA++;
            if ($w === $this->T568B[$i]) $scoreB++;
        }

        return response()->json([
            'ok' => false,
            'hint' => $scoreA >= $scoreB ? 'Lebih dekat ke T568A' : 'Lebih dekat ke T568B',
            'matchA' => $scoreA,
            'matchB' => $scoreB,
        ]);
    }

    public function saveResult(Request $request)
{
    try {

        SimulationResult::create([
            'name' => $request->name,
            'absen' => $request->absen,
            'score' => $request->score,
            'status_t568a' => $request->status_t568a,
            'status_t568b' => $request->status_t568b,
            'time_used' => $request->time_used,
            'cable_used' => $request->cable_used,
            'rj45_used' => $request->rj45_used,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil disimpan'
        ]);

    } catch (\Exception $e) {

        return response()->json([
            'status' => 'error',
            'message' => 'Gagal menyimpan data'
        ], 500);

    }
}

}