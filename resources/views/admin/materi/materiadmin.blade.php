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

<!-- Judul -->
<div class="mb-4">
<label class="font-semibold">Judul</label>
<input type="text" name="title" value="{{ $course['title'] }}"
class="w-full border rounded px-3 py-2">
</div>

<!-- Subjudul -->
<div class="mb-4">
<label class="font-semibold">Subjudul</label>
<input type="text" name="subtitle" value="{{ $course['subtitle'] }}"
class="w-full border rounded px-3 py-2">
</div>

<!-- XP -->
<div class="grid grid-cols-2 gap-4 mb-4">
<div>
<label>XP Reward</label>
<input type="number" name="xpReward" value="{{ $course['xpReward'] }}"
class="w-full border rounded px-3 py-2">
</div>

<div>
<label>Max Score</label>
<input type="number" name="maxScore" value="{{ $course['maxScore'] }}"
class="w-full border rounded px-3 py-2">
</div>
</div>

<!-- Deskripsi -->
<div class="mb-4">
<label>Deskripsi</label>
<textarea name="description"
class="w-full border rounded px-3 py-2">{{ $course['description'] }}</textarea>
</div>

<button class="bg-indigo-600 text-white px-6 py-2 rounded">
Simpan & Preview
</button>

</form>
</div>

</body>
</html>