@extends('layouts.admin')

@section('content')
<section class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Manajemen Materi</h4>

        <a href="{{ route('materi.create') }}" class="btn btn-primary">
            + Tambah Materi
        </a>
    </div>

    {{-- Alert Success --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">

            <thead class="table-dark text-center">
                <tr>
                    <th width="5%">No</th>
                    <th width="15%">Thumbnail</th>
                    <th>Judul Materi</th>
                    <th width="25%">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($materis as $index => $materi)
                <tr>
                    <td class="text-center">
                        {{ $index + 1 }}
                    </td>

                    {{-- Gambar --}}
                    <td class="text-center">
                        <img src="{{ asset('storage/materi/'.$materi->thumbnail) }}"
                             width="100"
                             class="img-fluid rounded">
                    </td>

                    {{-- Judul --}}
                    <td>
                        <strong>{{ $materi->judul }}</strong><br>
                        <small class="text-muted">
                            Dibuat: {{ $materi->created_at->format('d M Y') }}
                        </small>
                    </td>

                    {{-- Aksi --}}
                    <td class="text-center">

                        {{-- Preview --}}
                        <a href="{{ route('materi.show', $materi->id) }}"
                           class="btn btn-info btn-sm">
                           Preview
                        </a>

                        {{-- Edit --}}
                        <a href="{{ route('materi.edit', $materi->id) }}"
                           class="btn btn-warning btn-sm">
                           Edit
                        </a>

                        {{-- Hapus --}}
                        <form action="{{ route('materi.destroy', $materi->id) }}"
                              method="POST"
                              class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin hapus materi ini?')">
                                Hapus
                            </button>
                        </form>

                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">
                        Data materi belum ada
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>
    </div>

</section>
@endsection
