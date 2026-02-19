@extends('layouts.admin')

@section('content')
<section class="flex-1 p-8 md:p-12 overflow-y-auto h-full flex flex-col items-center">
    <div class="w-full max-w-4xl">
        
        <div class="mb-8 text-center md:text-left">
            <h1 class="text-3xl font-bold text-cabelista-blue mb-2">Kelola Video</h1>
        </div>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6 shadow-sm" role="alert">
            <strong class="font-bold">Berhasil!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        @endif

        <div class="bg-white rounded-3xl shadow-xl p-8 border border-gray-100">
            <form action="{{ route('admin.video.update') }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Input Link --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Link YouTube</label>
                    <input type="text" name="url" 
                           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                           placeholder="Paste link YouTube di sini (contoh: https://www.youtube.com/watch?v=...)"
                           value="{{ old('url', $video->url ?? '') }}" required>
                    <p class="text-sm text-gray-400 mt-2 italic">*Link otomatis dikonversi menjadi format embed.</p>
                </div>

                {{-- Preview --}}
                @if(isset($video->url))
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Preview Saat Ini:</label>
                    <div class="max-w-sm"> 
                    <div class="relative w-full pb-[56.25%] h-0 rounded-lg overflow-hidden shadow bg-black">
                    <iframe src="{{ $video->url }}" 
                        class="absolute top-0 left-0 w-full h-full"
                        title="Video Preview"
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                    </div>
                    </div>
                </div>
                @endif

                <div class="flex justify-end"> 
                    <button type="submit" class="px-6 py-2 rounded-lg font-medium bg-blue-500 hover:bg-blue-600 transition shadow-lg border border-blue-400 text-white flex items-center">
                        Simpan Video
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection