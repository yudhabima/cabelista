@extends('layouts.admin')

@section('content')
            <section class="flex-1 overflow-y-auto bg-white p-8">
                
                <h1 class="text-2xl font-bold text-[#004aad] mb-6">Halaman Materi</h1>

                <div class="mb-6">
                    <a href="{{ route('materi.create') }}"
   class="px-6 py-2 rounded-lg font-medium bg-blue-500 hover:bg-blue-600 transition shadow-lg border border-blue-400 text-white">
   Buat Materi
</a>
                </div>

                <div class="bg-white border border-gray-300 rounded-sm overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white border-b border-gray-300">
                                <th class="p-4 border-r border-gray-300 w-16 font-bold text-gray-800">No</th>
                                <th class="p-4 border-r border-gray-300 w-48 font-bold text-gray-800">Image</th>
                                <th class="p-4 border-r border-gray-300 font-bold text-gray-800">Judul</th>
                                <th class="p-4 font-bold text-gray-800 w-48">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-300 hover:bg-gray-50">
                                <td class="p-4 border-r border-gray-300">1</td>
                                <td class="p-4 border-r border-gray-300">
                                    <div class="w-24 h-16 bg-gray-400 rounded-md"></div>
                                </td>
                                <td class="p-4 border-r border-gray-300 font-medium text-gray-900">
                                    Pengenalan Kabel UTP
                                </td>
                                <td class="p-4">
                                    <div class="flex gap-2">
                                        <a href="#" class="px-4 py-1.5 bg-amber-400 hover:bg-amber-500 text-black text-sm font-medium rounded transition">
                                            Edit
                                        </a>
                                        <button class="px-4 py-1.5 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded transition">
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            </tbody>
                    </table>
                </div>

            </section>
@endsection