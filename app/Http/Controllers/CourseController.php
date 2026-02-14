<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    private function defaultData()
    {
        return [
            "title" => "Mengenal Kabel UTP",
            "subtitle" => "Unshielded Twisted Pair - Standar Kabel Jaringan Komputer",
            "tag" => "Pengenalan Kabel UTP",
            "xpReward" => 150,
            "maxScore" => 100,
            "levelProgress" => 0,
            "sectionTitle" => "Apa itu Kabel UTP?",
            "description" => "UTP (Unshielded Twisted Pair) adalah jenis kabel jaringan yang paling umum digunakan dalam instalasi LAN.",
            "characteristics" => [
                "Tidak memiliki pelindung metal",
                "Menggunakan konektor RJ45",
                "Panjang maksimal 100 meter",
                "Digunakan untuk Ethernet"
            ],
            "steps" => [
                ["id"=>1,"title"=>"Memahami definisi UTP","status"=>"completed"],
                ["id"=>2,"title"=>"Mengenali struktur kabel","status"=>"current"],
                ["id"=>3,"title"=>"Memahami fungsi twisted pair","status"=>"locked"],
            ]
        ];
    }

    public function edit()
    {
        $course = session('course', $this->defaultData());
        return view('course.edit', compact('course'));
    }

    public function update(Request $request)
    {
        $data = $request->all();

        session(['course' => $data]);

        return redirect()->route('course.preview');
    }

    public function preview()
    {
        $course = session('course', $this->defaultData());
        return view('course.preview', compact('course'));
    }
}
