<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Materi</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow">

<h1 class="text-xl font-bold mb-6">Edit Materi</h1>

<form action="{{ route('course.update') }}" method="POST">
@csrf

{{-- ================= HEADER ================= --}}
<div class="mb-4">
<label class="font-semibold">Judul</label>
<input type="text" name="title" value="{{ $course['title'] }}"
class="w-full border rounded px-3 py-2">
</div>

{{-- ================= KARAKTERISTIK ================= --}}
<h2 class="font-bold mt-6 mb-2">Karakteristik</h2>

<div id="characteristics-wrapper">

@foreach($course['characteristics'] as $char)
<div class="flex gap-2 mb-2">
<input type="text" name="characteristics[]" value="{{ $char }}"
class="flex-1 border rounded px-3 py-2">

<button type="button"
onclick="removeItem(this)"
class="bg-red-500 text-white px-3 rounded">
Hapus
</button>
</div>
@endforeach

</div>

<button type="button"
onclick="addCharacteristic()"
class="bg-indigo-500 text-white px-4 py-2 rounded mt-2">
+ Tambah Karakteristik
</button>

{{-- ================= STEPS ================= --}}
<h2 class="font-bold mt-8 mb-2">Langkah Pembelajaran</h2>

<div id="steps-wrapper">

@foreach($course['steps'] as $i => $step)
<div class="border p-3 rounded mb-2">

<input type="text"
name="steps[{{ $i }}][title]"
value="{{ $step['title'] }}"
class="w-full border rounded px-2 py-1 mb-2"
placeholder="Judul langkah">

<select name="steps[{{ $i }}][status]"
class="w-full border rounded px-2 py-1 mb-2">

<option value="locked" {{ $step['status']=='locked'?'selected':'' }}>Locked</option>
<option value="current" {{ $step['status']=='current'?'selected':'' }}>Current</option>
<option value="completed" {{ $step['status']=='completed'?'selected':'' }}>Completed</option>

</select>

<button type="button"
onclick="removeItem(this)"
class="bg-red-500 text-white px-3 py-1 rounded text-sm">
Hapus
</button>

</div>
@endforeach

</div>

<button type="button"
onclick="addStep()"
class="bg-indigo-500 text-white px-4 py-2 rounded mt-2">
+ Tambah Step
</button>

{{-- ================= SUBMIT ================= --}}
<div class="mt-8">
<button class="bg-green-600 text-white px-6 py-2 rounded">
Simpan & Preview
</button>
</div>

</form>
</div>

{{-- ================= JS DYNAMIC ================= --}}
<script>

function addCharacteristic() {
    const wrapper = document.getElementById('characteristics-wrapper');

    wrapper.insertAdjacentHTML('beforeend', `
        <div class="flex gap-2 mb-2">
            <input type="text" name="characteristics[]"
            class="flex-1 border rounded px-3 py-2"
            placeholder="Isi karakteristik">

            <button type="button"
            onclick="removeItem(this)"
            class="bg-red-500 text-white px-3 rounded">
            Hapus
            </button>
        </div>
    `);
}

function addStep() {
    const wrapper = document.getElementById('steps-wrapper');
    const index = wrapper.children.length;

    wrapper.insertAdjacentHTML('beforeend', `
        <div class="border p-3 rounded mb-2">

            <input type="text"
            name="steps[${index}][title]"
            class="w-full border rounded px-2 py-1 mb-2"
            placeholder="Judul langkah">

            <select name="steps[${index}][status]"
            class="w-full border rounded px-2 py-1 mb-2">

                <option value="locked">Locked</option>
                <option value="current">Current</option>
                <option value="completed">Completed</option>

            </select>

            <button type="button"
            onclick="removeItem(this)"
            class="bg-red-500 text-white px-3 py-1 rounded text-sm">
            Hapus
            </button>

        </div>
    `);
}

function removeItem(btn) {
    btn.parentElement.remove();
}

</script>

</body>
</html>
