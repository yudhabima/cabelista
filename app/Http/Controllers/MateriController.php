<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\MaterialStep;
use Illuminate\Support\Facades\Auth;
use App\Models\MaterialProgress;

class MateriController extends Controller
{
    public function index()
    {
        $materials = Material::all();
        return view('admin.materi.index', compact('materials'));
    }

    public function create()
    {
        return view('admin.materi.create');
    }

public function store(Request $request)
{
    // upload gambar
    $imagePath = null;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')
            ->store('materials', 'public');
    }

    // simpan material utama (HANYA SEKALI)
    $material = Material::create([
        'title' => $request->title,
        'description' => $request->description,
        'content' => '-', // wajib isi karena DB tidak nullable
        'image' => $imagePath,
        'xp_reward' => $request->xp_reward,
        'total_score' => $request->total_score ?? 0,
        'xp_point' => 0,
        'progress_level' => 0,
    ]);

    $totalSteps = 0;

    // simpan steps
    if ($request->steps) {

        foreach ($request->steps as $index => $step) {

            if (!empty($step['title'])) {

                $material->steps()->create([
                    'step_number' => $index + 1,
                    'title' => $step['title'],
                    'content' => $step['content'],
                ]);

                $totalSteps++;
            }
        }
    }

    // update progress level otomatis
    $material->update([
        'progress_level' => $totalSteps
    ]);

    return redirect()->route('materi.index')
        ->with('success', 'Materi berhasil ditambahkan');
}


    public function show($id)
    {
        $material = Material::findOrFail($id);
        return view('admin.materi.show', compact('material'));
    }

    public function edit($id)
{
    $material = Material::with(['steps','quizzes'])->findOrFail($id);

    return view('admin.materi.edit', compact('material'));
}

    public function update(Request $request, $id)
{
    $material = Material::findOrFail($id);

    // upload gambar
    $imagePath = $material->image;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')
            ->store('materials', 'public');
    }

    // update materi utama
    $material->update([
        'title' => $request->title,
        'description' => $request->description,
        'image' => $imagePath,
        'xp_reward' => $request->xp_reward,
    ]);

    // ======================
    // UPDATE STEPS
    // ======================
    $material->steps()->delete();
    $totalSteps = 0;

    if($request->steps){
    foreach($request->steps as $index => $step){

        if(!empty($step['title'])){

            $material->steps()->create([
                'step_number' => $index + 1,
                'title' => $step['title'],
                'content' => $step['content'],
            ]);

            $totalSteps++;
        }
    }
    }

    // update progress level otomatis
    $material->update([
        'progress_level' => $totalSteps
    ]);

    // ======================
    // UPDATE QUIZ
    // ======================
    $material->quizzes()->delete();

    if($request->quiz){
        foreach($request->quiz as $quiz){
            if(!empty($quiz['question'])){
                $material->quizzes()->create([
                    'question' => $quiz['question'],
                    'A' => $quiz['A'],
                    'B' => $quiz['B'],
                    'C' => $quiz['C'],
                    'D' => $quiz['D'],
                    'answer' => $quiz['answer'],
                ]);
            }
        }
    }

    return redirect()
        ->route('materi.index')
        ->with('success','Materi berhasil diupdate');
}

    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        $material->delete();

        return redirect()
            ->route('materi.index')
            ->with('success','Materi berhasil dihapus');
    }

    public function completeStep($id)
{
    $user = Auth::user();

    $material = Material::with('steps')->findOrFail($id);

    // cari progress user
    $progress = MaterialProgress::firstOrCreate(
        [
            'user_id' => $user->id,
            'material_id' => $material->id,
        ],
        [
            'current_step' => 1,
            'is_completed' => false
        ]
    );

    // total step
    $totalSteps = $material->steps->count();

    // XP per step
    $xpPerStep = floor($material->xp_reward / $totalSteps);

    // naikkan step
    $progress->current_step += 1;

    // tambah XP user
    $user->increment('total_xp', $xpPerStep);

    // cek selesai
    if ($progress->current_step > $totalSteps) {
        $progress->is_completed = true;
    }

    $progress->save();

    return response()->json([
        'success' => true,
        'xp_added' => $xpPerStep,
        'total_xp' => $user->total_xp,
        'current_step' => $progress->current_step
    ]);
}
}
