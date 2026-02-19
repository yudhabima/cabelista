@extends('layouts.admin')

@section('content')

<section class="flex-1 overflow-y-auto bg-white p-8">

    <h1 class="text-2xl font-bold text-[#004aad] mb-6">
        Halaman Materi
    </h1>

    {{-- tombol tambah --}}
    <div class="mb-6">
        <a href="{{ route('materi.create') }}"
            class="px-6 py-2 rounded-lg font-medium bg-blue-500 hover:bg-blue-600 transition shadow-lg border border-blue-400 text-white">
            Buat Materi
        </a>
    </div>

    {{-- alert success --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white border border-gray-300 rounded-sm overflow-hidden">

        <table class="w-full text-left border-collapse">

            <thead>
                <tr class="bg-white border-b border-gray-300">
                    <th class="p-4 border-r border-gray-300 w-16 font-bold text-gray-800">No</th>
                    <th class="p-4 border-r border-gray-300 w-48 font-bold text-gray-800">Image</th>
                    <th class="p-4 border-r border-gray-300 font-bold text-gray-800">Judul</th>
                    <th class="p-4 font-bold text-gray-800 w-56">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($materials as $index => $materi)

                <tr class="border-b border-gray-300 hover:bg-gray-50">

                    {{-- nomor --}}
                    <td class="p-4 border-r border-gray-300">
                        {{ $index + 1 }}
                    </td>

                    {{-- image --}}
                    <td class="p-4 border-r border-gray-300">
                        @if($materi->image)
                            <img src="{{ asset('storage/'.$materi->image) }}"
                                class="w-24 h-16 object-cover rounded">
                        @else
                            <div class="w-24 h-16 bg-gray-300 rounded"></div>
                        @endif
                    </td>

                    {{-- judul --}}
                    <td class="p-4 border-r border-gray-300 font-medium text-gray-900">
                        {{ $materi->title }}
                        <div class="text-xs text-gray-500">
                            {{ $materi->created_at->format('d M Y') }}
                        </div>
                    </td>

                    {{-- aksi --}}
                    <td class="p-4">
                        <div class="flex gap-2">

                            <a href="{{ route('materi.show',$materi->id) }}"
                                class="px-4 py-1.5 bg-sky-500 hover:bg-sky-600 text-white text-sm font-medium rounded transition">
                                Preview
                            </a>

                            <a href="{{ route('materi.edit',$materi->id) }}"
                                class="px-4 py-1.5 bg-amber-400 hover:bg-amber-500 text-black text-sm font-medium rounded transition">
                                Edit
                            </a>

                            <form action="{{ route('materi.destroy',$materi->id) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Yakin hapus materi ini?')"
                                    class="px-4 py-1.5 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded transition">
                                    Hapus
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="4" class="p-6 text-center text-gray-500">
                        Data materi belum ada
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</section>

@endsection
