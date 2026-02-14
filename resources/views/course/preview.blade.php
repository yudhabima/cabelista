<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Preview Materi</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="max-w-5xl mx-auto">

<!-- Header -->
<div class="bg-white p-6 rounded-xl shadow mb-6 text-center">
<span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm">
{{ $course['tag'] }}
</span>

<h1 class="text-3xl font-bold text-indigo-600 mt-3">
{{ $course['title'] }}
</h1>

<p class="text-gray-500">{{ $course['subtitle'] }}</p>
</div>

<!-- XP & Score -->
<div class="flex gap-4 mb-6">
<div class="bg-orange-500 text-white px-4 py-3 rounded-lg">
XP : {{ $course['xpReward'] }}
</div>

<div class="bg-indigo-500 text-white px-4 py-3 rounded-lg">
Score : 0 / {{ $course['maxScore'] }}
</div>
</div>

<!-- Konten -->
<div class="bg-white p-6 rounded-xl shadow">

<h2 class="text-xl font-bold mb-3">
{{ $course['sectionTitle'] }}
</h2>

<p class="text-gray-700 mb-4">
{{ $course['description'] }}
</p>

<h3 class="font-semibold mb-2">Karakteristik:</h3>

<ul class="list-disc pl-6 space-y-1">
@foreach($course['characteristics'] as $char)
<li>{{ $char }}</li>
@endforeach
</ul>

</div>

<!-- Steps -->
<div class="bg-white p-6 rounded-xl shadow mt-6">

<h3 class="font-bold mb-4">Langkah Pembelajaran</h3>

@foreach($course['steps'] as $step)
<div class="border-b py-2 flex justify-between">
<span>{{ $step['title'] }}</span>
<span class="text-xs text-gray-500">{{ $step['status'] }}</span>
</div>
@endforeach

</div>

</div>

</body>
</html>
