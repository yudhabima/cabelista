<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    // 🔹 TAMPIL HALAMAN KELOLA VIDEO
    public function index()
    {
        $video = Video::first();

        return view('admin.video.index', compact('video'));
    }

    // 🔹 UPDATE VIDEO
    public function update(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
            'title' => 'nullable|string'
        ]);

        $url = $request->url;

        // Ubah link YouTube ke embed
        if (str_contains($url, 'youtube.com/watch?v=')) {
            $parseUrl = parse_url($url);
            parse_str($parseUrl['query'], $params);
            if (isset($params['v'])) {
                $url = 'https://www.youtube.com/embed/' . $params['v'];
            }
        } 
        elseif (str_contains($url, 'youtu.be/')) {
            $parts = explode('youtu.be/', $url);
            if (isset($parts[1])) {
                $videoId = explode('?', $parts[1])[0];
                $url = 'https://www.youtube.com/embed/' . $videoId;
            }
        }

        Video::updateOrCreate(
            ['id' => 1],
            [
                'url' => $url,
                'title' => $request->title ?? 'Video Tutorial'
            ]
        );

        return redirect()->back()->with('success', 'Video Landing Page berhasil diperbarui!');
    }
}
