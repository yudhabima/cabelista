<!DOCTYPE html>

<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Create Materi Gamifikasi</title>
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js"></script>

<style>
    body {
        background: linear-gradient(135deg,#eef2ff,#f8fafc);
    }

    .card-glass {
        background: rgba(255,255,255,0.9);
        backdrop-filter: blur(10px);
    }

    .animate-fade-in {
        animation: fadeIn 0.4s ease-out;
    }

    @keyframes fadeIn {
        from { opacity:0; transform: translateY(10px); }
        to { opacity:1; transform: translateY(0); }
    }
</style>

</head>

<body class="min-h-screen p-10">

<div class="max-w-6xl mx-auto">

{{-- HEADER --}}
<div class="mb-8">
    <h1 class="text-3xl font-bold text-indigo-700">Buat Materi Cabelista</h1>
    <p class="text-gray-500">Lengkapi informasi materi, langkah pembelajaran, dan quiz.</p>
</div>

<form action="{{ route('materi.store') }}" method="POST" enctype="multipart/form-data"onsubmit="tinymce.triggerSave();">
@csrf

{{-- ================= INFO MATERI ================= --}}
<div class="card-glass shadow-xl rounded-2xl p-8 mb-8 border">
    <h2 class="font-bold text-lg mb-6 text-indigo-700">Informasi Materi</h2>

    <div class="grid md:grid-cols-2 gap-6">

        <div class="md:col-span-2">
            <label class="font-semibold text-sm">Judul Materi</label>
            <input type="text" name="title" class="w-full mt-1 rounded-lg border-2 border-gray-300 px-3 py-2" placeholder="Contoh: Pengenalan Kabel UTP">
        </div>

        <div>
            <label class="font-semibold text-sm">XP Reward</label>
            <input type="number" name="xp_reward" class="w-full mt-1 rounded-lg border-2 border-gray-300 px-3 py-2" value="100">
        </div>

        <div>
            <label class="font-semibold text-sm">Total Skor</label>
            <input type="number" name="total_score" class="w-full mt-1 rounded-lg border-2 border-gray-300 px-3 py-2" value="100">
        </div>

        <div class="md:col-span-2">
            <label class="font-semibold text-sm">Deskripsi</label>
            <textarea name="description" rows="3" class="w-full mt-1 rounded-lg border-2 border-gray-300 px-2 py-1"></textarea>
        </div>

        <div class="md:col-span-2">
            <label class="font-semibold text-sm">Cover</label>
            <input type="file" name="image" class="mt-1">
        </div>

    </div>
</div>

{{-- ================= LANGKAH ================= --}}
<div class="card-glass shadow-xl rounded-2xl p-8 mb-8 border">
    <div class="flex justify-between mb-6">
        <h2 class="font-bold text-lg text-indigo-700">Langkah Pembelajaran</h2>
        <button type="button" onclick="addStep()"
            class="bg-indigo-600 text-white px-4 py-2 rounded-lg shadow hover:bg-indigo-700">
            + Tambah
        </button>
    </div>

    <div id="steps-container" class="space-y-4">

        <div class="border rounded-xl p-6 bg-gray-50 step-card relative">
            <button type="button"
                onclick="removeItem(this)"
                class="absolute top-3 right-3 bg-red-500 text-white px-3 py-1 rounded-lg text-sm hover:bg-red-600">
                Hapus
            </button>

            <label class="font-semibold text-sm">Judul Langkah</label>
            <input type="text" name="steps[0][title]" class="w-full mt-1 rounded-lg border-2 border-gray-300 px-3 py-2" placeholder="Contoh: Memahami definisi UTP">

            <label class="font-semibold text-sm mt-4 block">Isi Materi</label>
            <textarea id="step-content-0" name="steps[0][content]" rows="3" class="w-full mt-1 rounded-lg border-2 border-gray-300 px-2 py-1"></textarea>

            <label class="font-semibold text-sm mt-4 block">Progress Level (%)</label>
            <input type="number" name="steps[0][progress]" class="w-full mt-1 rounded-lg border-2 border-gray-300 px-3 py-2" value="10">
        </div>

    </div>
</div>

{{-- ================= QUIZ ================= --}}
<div class="card-glass shadow-xl rounded-2xl p-8 mb-8 border">
    <div class="flex justify-between mb-6">
        <h2 class="font-bold text-lg text-indigo-700">Quiz</h2>
        <button type="button" onclick="addQuiz()"
            class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700">
            + Tambah Soal
        </button>
    </div>

    <div id="quiz-container" class="space-y-4">

        <div class="border rounded-xl p-6 bg-gray-50 relative">

            <button type="button"
                onclick="removeItem(this)"
                class="absolute top-3 right-3 bg-red-500 text-white px-3 py-1 rounded-lg text-sm hover:bg-red-600">
                Hapus
            </button>

            <label class="font-semibold text-sm">Pertanyaan</label>
            <input type="text" name="quiz[0][question]" class="w-full mt-1 rounded-lg border-2 border-gray-300 px-3 py-2">

            <div class="grid grid-cols-2 gap-3 mt-4">
                <input type="text" name="quiz[0][A]" placeholder="Opsi A" class="rounded-lg border-2 border-gray-300 px-3 py-2">
                <input type="text" name="quiz[0][B]" placeholder="Opsi B" class="rounded-lg border-2 border-gray-300 px-3 py-2">
                <input type="text" name="quiz[0][C]" placeholder="Opsi C" class="rounded-lg border-2 border-gray-300 px-3 py-2">
                <input type="text" name="quiz[0][D]" placeholder="Opsi D" class="rounded-lg border-2 border-gray-300 px-3 py-2">
            </div>

            <label class="font-semibold text-sm mt-4 block">Jawaban Benar</label>
            <select name="quiz[0][answer]" class="rounded-lg border-gray-300 mt-1">
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>

        </div>

    </div>
</div>

{{-- SUBMIT --}}
<div class="text-right">
    <button class="bg-indigo-700 text-white px-8 py-3 rounded-xl shadow-lg hover:scale-105 transition">
        Simpan Materi
    </button>
</div>

</form>

</div>

{{-- ================= JS ================= --}}

<script>
function initTinyMCE(selector) {
    tinymce.init({
        selector: selector,
        height: 250,
        menubar: false,
        elementpath: false,
        plugins: 'lists link',
        toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
        branding: false, // Menghilangkan tulisan "Powered by TinyMCE"
        promotion: false // Menghilangkan tombol upgrade
    });
}

// Inisialisasi editor untuk form langkah pertama saat halaman dimuat
document.addEventListener("DOMContentLoaded", function() {
    initTinyMCE('#step-content-0');
});

// ================= STEPS =================
let stepIndex = 1;

function addStep() {
    // Buat ID unik untuk textarea baru
    const stepId = `step-content-${stepIndex}`;

    const html = `
<div class="border rounded-xl p-6 bg-gray-50 animate-fade-in relative">

    <button type="button" 
        onclick="removeItem(this, '${stepId}')" 
        class="absolute top-3 right-3 bg-red-500 text-white px-3 py-1 rounded-lg text-sm hover:bg-red-600">
        Hapus
    </button>

    <label class="font-semibold text-sm">Judul Langkah</label>
    <input type="text" 
        name="steps[${stepIndex}][title]" 
        class="w-full mt-1 rounded-lg border-2 border-gray-300 px-3 py-2">

    <label class="font-semibold text-sm mt-4 block">Isi Materi</label>
    <textarea id="${stepId}"
        name="steps[${stepIndex}][content]" 
        rows="3" 
        class="w-full mt-1 rounded-lg border-2 border-gray-300 px-2 py-1"></textarea>

    <label class="font-semibold text-sm mt-4 block">Progress Level (%)</label>
    <input type="number" 
        name="steps[${stepIndex}][progress]" 
        class="w-full mt-1 rounded-lg border-2 border-gray-300 px-3 py-2" 
        value="10">
</div>
`;

    document
        .getElementById('steps-container')
        .insertAdjacentHTML('beforeend', html);

    // Inisialisasi TinyMCE pada textarea yang baru saja ditambahkan
    initTinyMCE(`#${stepId}`);

    stepIndex++;
}


let quizIndex = 1;

function addQuiz() {

    const html = `
<div class="border rounded-xl p-6 bg-gray-50 animate-fade-in relative">

    <button type="button"
        onclick="removeItem(this)"
        class="absolute top-3 right-3 bg-red-500 text-white px-3 py-1 rounded-lg text-sm hover:bg-red-600">
        Hapus
    </button>

    <label class="font-semibold text-sm">Pertanyaan</label>
    <input type="text"
        name="quiz[${quizIndex}][question]"
        class="w-full mt-1 rounded-lg border-2 border-gray-300 px-3 py-2">

    <div class="grid grid-cols-2 gap-3 mt-4">
        <input type="text" name="quiz[${quizIndex}][A]" placeholder="Opsi A" class="rounded-lg border-2 border-gray-300 px-3 py-2">
        <input type="text" name="quiz[${quizIndex}][B]" placeholder="Opsi B" class="rounded-lg border-2 border-gray-300 px-3 py-2">
        <input type="text" name="quiz[${quizIndex}][C]" placeholder="Opsi C" class="rounded-lg border-2 border-gray-300 px-3 py-2">
        <input type="text" name="quiz[${quizIndex}][D]" placeholder="Opsi D" class="rounded-lg border-2 border-gray-300 px-3 py-2">
    </div>

    <label class="font-semibold text-sm mt-4 block">Jawaban Benar</label>
    <select name="quiz[${quizIndex}][answer]"
        class="rounded-lg border-gray-300 mt-1">
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

function removeItem(button, editorId = null) {
    if(editorId) {
        // Hapus instance TinyMCE terlebih dahulu jika ada
        tinymce.get(editorId)?.remove();
    }
    button.parentElement.remove();
}

function completeStep(materialId){

    fetch(`/material/${materialId}/complete-step`, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN":
                document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(res => res.json())
    .then(data => {

        alert("XP +" + data.xp_added);

        console.log("Total XP:", data.total_xp);
    });
}
</script>


</body>
</html>
