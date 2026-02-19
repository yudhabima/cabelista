<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Materi Cabelista</title>

<script src="https://cdn.tailwindcss.com"></script>

<style>
body {
    background: linear-gradient(135deg,#eef2ff,#f8fafc);
}
</style>

</head>

<body class="min-h-screen p-10">

<section class="max-w-6xl mx-auto">

<h1 class="text-3xl font-bold text-indigo-700 mb-6">
    Edit Materi Cabelista
</h1>

<form action="{{ route('materi.update',$material->id) }}"
      method="POST"
      enctype="multipart/form-data">

@csrf
@method('PUT')

{{-- INFO MATERI --}}
<div class="bg-white rounded-2xl shadow-xl p-8 mb-8">

    <label class="font-semibold text-sm">Judul</label>
    <input name="title"
        value="{{ $material->title }}"
        class="w-full border-2 rounded-lg p-2 mb-4">

    <label class="font-semibold text-sm">Deskripsi</label>
    <textarea name="description"
        class="w-full border-2 rounded-lg p-2 mb-4">{{ $material->description }}</textarea>

    <label class="font-semibold text-sm">XP Reward</label>
    <input type="number"
        name="xp_reward"
        value="{{ $material->xp_reward }}"
        class="w-full border-2 rounded-lg p-2">

    <label class="font-semibold text-sm">Total Skor</label>

    <input type="number"
        name="total_score"
        value="{{ $material->total_score }}"
        class="w-full border-2 rounded-lg p-2">

{{-- COVER IMAGE --}}
    <label class="font-semibold text-sm">Ganti Cover Materi</label>

    <input type="file"
        name="image"
        class="w-full border-2 rounded-lg p-2 mt-1">

    {{-- Preview gambar lama --}}
    @if($material->image)
        <div class="mt-3">
            <p class="text-xs text-gray-500 mb-2">Gambar saat ini:</p>
            <img src="{{ asset('storage/'.$material->image) }}"
                class="w-48 rounded-lg shadow object-cover">
        </div>
    @endif
</div>

{{-- LANGKAH --}}
<div class="bg-white rounded-2xl shadow-xl p-8 mb-8">

<h2 class="font-bold text-lg text-indigo-700 mb-4">
    Langkah Pembelajaran
</h2>

<div id="steps-container" class="space-y-4">

    @foreach($material->steps as $i => $step)
    <div class="border rounded-xl p-4 mb-4 relative">

    <button type="button"
    onclick="removeItem(this)"
    class="absolute right-3 top-3 bg-red-500 text-white px-2 rounded">
    Hapus
    </button>

<label class="font-semibold text-sm">Judul Langkah</label>
<input name="steps[{{$i}}][title]"
value="{{$step->title}}"
class="w-full mt-1 rounded-lg border-2 border-gray-300 px-2 py-1">

 <label class="font-semibold text-sm">Isi Materi</label>
<textarea name="steps[{{$i}}][content]"
class="w-full mt-1 rounded-lg border-2 border-gray-300 px-2 py-1">{{$step->content}}</textarea>

    <label class="font-semibold text-sm">Progress Level (Auto)</label>

    <input type="number"
        value="{{ $material->progress_level }}"
        readonly
        class="w-full border-2 rounded-lg p-2 bg-gray-100">
    
</div>
@endforeach

</div>

<button type="button"
onclick="addStep()"
class="bg-indigo-600 text-white px-4 py-2 rounded">
+ Tambah Langkah
</button>

</div>

{{-- QUIZ --}}
<div class="bg-white rounded-2xl shadow-xl p-8 mb-8">

<h2 class="font-bold text-lg text-indigo-700 mb-4">
    Quiz
</h2>

<div id="quiz-container">

@foreach($material->quizzes as $i => $quiz)
<div class="border rounded-xl p-4 mb-4 relative">

<button type="button"
onclick="removeItem(this)"
class="absolute right-3 top-3 bg-red-500 text-white px-2 rounded">
Hapus
</button>

<label class="font-semibold text-sm">Pertanyaan</label>
<input name="quiz[{{$i}}][question]"
value="{{$quiz->question}}"
class="w-full border p-2 mb-2 rounded">

<div class="grid grid-cols-2 gap-2">
<input name="quiz[{{$i}}][A]" value="{{$quiz->A}}" class="border p-2 rounded">
<input name="quiz[{{$i}}][B]" value="{{$quiz->B}}" class="border p-2 rounded">
<input name="quiz[{{$i}}][C]" value="{{$quiz->C}}" class="border p-2 rounded">
<input name="quiz[{{$i}}][D]" value="{{$quiz->D}}" class="border p-2 rounded">
</div>

<label class="font-semibold text-sm mt-4 block">Jawaban Benar</label>
<select name="quiz[{{$i}}][answer]" class="border p-2 rounded mt-2">
<option {{ $quiz->answer=='A'?'selected':'' }}>A</option>
<option {{ $quiz->answer=='B'?'selected':'' }}>B</option>
<option {{ $quiz->answer=='C'?'selected':'' }}>C</option>
<option {{ $quiz->answer=='D'?'selected':'' }}>D</option>
</select>

</div>
@endforeach

</div>

<button type="button"
onclick="addQuiz()"
class="bg-green-600 text-white px-4 py-2 rounded">
+ Tambah Quiz
</button>

</div>

<div class="text-right">
<button class="bg-indigo-700 text-white px-8 py-3 rounded-xl">
Update Materi
</button>
</div>

</form>

</section>

<script>

let stepIndex = {{ $material->steps->count() }};
let quizIndex = {{ $material->quizzes->count() }};

function addStep() {

    const html = `
    <div class="border rounded-xl p-4 mb-4 relative">

        <button type="button"
            onclick="removeItem(this)"
            class="absolute right-3 top-3 bg-red-500 text-white px-2 rounded">
            Hapus
        </button>

        <input name="steps[${stepIndex}][title]"
            class="w-full border p-2 mb-2 rounded"
            placeholder="Judul langkah">

        <textarea name="steps[${stepIndex}][content]"
            class="w-full border p-2 rounded"
            placeholder="Isi materi"></textarea>

        <label class="font-semibold text-sm mt-4 block">Progress Level (%)</label>
        <input type="number"
        value="{{ $material->progress_level }}"
        class="w-full mt-1 rounded-lg border-2 border-gray-300 px-3 py-2"
        placeholder="Progress level otomatis dihitung berdasarkan jumlah langkah">
    </div>
    `;

    document
        .getElementById('steps-container')
        .insertAdjacentHTML('beforeend', html);

    stepIndex++;
}

function addQuiz() {

    const html = `
    <div class="border rounded-xl p-4 mb-4 relative">

        <button type="button"
            onclick="removeItem(this)"
            class="absolute right-3 top-3 bg-red-500 text-white px-2 rounded">
            Hapus
        </button>

        <label class="font-semibold text-sm">Pertanyaan</label>
        <input name="quiz[${quizIndex}][question]"
            class="w-full border p-2 mb-2 rounded"
            placeholder="Pertanyaan">

        <div class="grid grid-cols-2 gap-2">
            <input name="quiz[${quizIndex}][A]" class="border p-2 rounded" placeholder="A">
            <input name="quiz[${quizIndex}][B]" class="border p-2 rounded" placeholder="B">
            <input name="quiz[${quizIndex}][C]" class="border p-2 rounded" placeholder="C">
            <input name="quiz[${quizIndex}][D]" class="border p-2 rounded" placeholder="D">
        </div>

        <label class="font-semibold text-sm mt-4 block">Jawaban Benar</label>
        <select name="quiz[${quizIndex}][answer]"
            class="border p-2 rounded mt-2">
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
        </select>

    </div>
    `;

    document
        .getElementById('quiz-container')
        .insertAdjacentHTML('beforeend', html);

    quizIndex++;
}

function removeItem(btn){
    btn.parentElement.remove();
}

</script>

</body>
</html>
