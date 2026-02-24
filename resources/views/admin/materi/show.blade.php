<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Materi Cabelista</title>

<script src="https://cdn.tailwindcss.com"></script>
<script src="https://unpkg.com/lucide@latest"></script>

<style>
.content-section{display:none;}
.content-section.active{display:block;}
.step-indicator.active{
    background:linear-gradient(135deg,#3b82f6,#2563eb);
}

.logo img {
            height: 45px; /* ukuran logo */
            width: auto;
            display: block;
        }
        
</style>

</head>

<body class="bg-gradient-to-br from-blue-50 via-white to-green-50 min-h-screen">

<div class="p-4">

    <!-- TOP BAR -->
    <div class="bg-white rounded-2xl shadow-xl p-4 mb-4 border-b-4 border-blue-500">
        <div class="flex justify-between">

            
            <div class="flex items-center gap-2">
                        <div class="logo">
                 <img src="/assets/img/logo-cabelista.png" alt="Logo Cabelista">
                    </div>
            </div>
            </div>
        </div>
    </div>

    <div class="max-w-20xl mx-auto px-6 py-8">
    <div class="flex flex-col lg:flex-row gap-8">

        <!-- MAIN CONTENT -->
        <div class="flex-1">
            <div class="px-2"></div>

            <div class="bg-white rounded-2xl shadow-xl p-8 lg:p-10 border-t-4 border-purple-500">

                <div class="text-center mb-6">
                    <h2 class="text-3xl font-bold text-blue-700">
                        {{ $material->title }}
                    </h2>
                    <p class="text-gray-600 mt-2">
                        {{ $material->description }}
                    </p>
                </div>

                {{-- STEP CONTENT --}}
                @foreach($material->steps as $index => $step)

                <div id="section-{{$index+1}}"
                     class="content-section {{ $index==0 ? 'active' : '' }}">

                    <div class="bg-blue-50 rounded-xl p-6 border">
                        <h3 class="text-xl font-bold text-blue-700 mb-3">
                            {{ $step->title }}
                        </h3>

                        <p class="text-gray-700">
                            {{ $step->content }}
                        </p>
                    </div>

                    <button onclick="nextSection({{ $loop->last ? $material->steps->count()+1 : $index+2 }})"
                        class="mt-4 w-full py-4 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-xl font-bold text-lg hover:shadow-xl transition-all hover:scale-105 flex items-center justify-center gap-2">
                        {{ $loop->last ? 'Mulai Quiz' : 'Lanjutkan' }}
                    </button>
                </div>

                @endforeach

                {{-- QUIZ --}}
                <div id="section-quiz" class="content-section">
                    <div class="text-center mb-6">
                        <div class="inline-block bg-yellow-100 px-4 py-2 rounded-full mb-3">
                        <span class="text-yellow-700 font-semibold text-sm">
                            🎯 Kuis Pemahaman
                        </span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">
                        Uji Pemahaman Anda
                        </h3>
                        <p class="text-gray-600">
                        Jawab pertanyaan berikut untuk menyelesaikan materi ini
                        </p>
                    </div>
                        @foreach($material->quizzes as $quiz)
                    <div class="bg-white rounded-xl p-6 shadow-md border-2 border-gray-200 quiz-item" data-question="{{ $loop->index + 1 }}">
                        <div class="flex items-start gap-3 mb-4">
                        <div class="bg-blue-500 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold flex-shrink-0">{{ $loop->index + 1 }}</div>
                        <p class="text-gray-800 font-semibold">
                        {{ $quiz->question }}</p>
                        </div>
                        <div class="space-y-2 ml-11">
                            <button onclick="checkAnswer(this,'{{ $quiz->answer }}','A')"
                                class="option-btn w-full text-left p-3 rounded-lg border-2 border-gray-300 cursor-pointer hover:border-blue-500 hover:bg-blue-50">
                                <span class="text-gray-700">A. {{ $quiz->A }}</span>
                            </button>

                            <button onclick="checkAnswer(this,'{{ $quiz->answer }}','B')"
                                class="option-btn w-full text-left p-3 rounded-lg border-2 border-gray-300 cursor-pointer hover:border-blue-500 hover:bg-blue-50">
                                <span class="text-gray-700">B. {{ $quiz->B }}</span>
                            </button>

                            <button onclick="checkAnswer(this,'{{ $quiz->answer }}','C')"
                                class="option-btn w-full text-left p-3 rounded-lg border-2 border-gray-300 cursor-pointer hover:border-blue-500 hover:bg-blue-50">
                                <span class="text-gray-700">C. {{ $quiz->C }}</span>
                            </button>

                            <button onclick="checkAnswer(this,'{{ $quiz->answer }}','D')"
                                class="option-btn w-full text-left p-3 rounded-lg border-2 border-gray-300 cursor-pointer hover:border-blue-500 hover:bg-blue-50">
                                <span class="text-gray-700">D. {{ $quiz->D }}</span>
                            </button>
                        </div>
                    </div>
                    @endforeach

        <!-- RESULT (DI LUAR FOREACH) -->
        <div id="quiz-result" class="mt-6 hidden">
            <div class="bg-gradient-to-r from-green-500 to-emerald-500 rounded-xl p-6 text-center text-white">
                <i data-lucide="trophy" class="mx-auto mb-3" style="width: 48px; height: 48px;"></i>
                <h3 class="text-2xl font-bold mb-2">Selamat!</h3>
                <p class="text-lg mb-4">
                    Skor Anda: <span id="final-score" class="font-bold">0</span>/{{ $material->quizzes->count() }}</p>
                <p class="mb-4">
                    Anda telah menyelesaikan semuanya dan siap melanjutkan ke perjalanan selanjutnya!
                </p>
                <a href="{{ url('/') }}"
                class="px-6 py-2 rounded-lg font-medium bg-blue-500 hover:bg-blue-600 transition shadow-lg border border-blue-400 inline-block">
                    Finish
                </a>
            </div>
        </div>
        </div>
    </div>
    </div>

        <!-- SIDEBAR PROGRESS -->
    <div class="w-full lg:w-80">

    <div class="bg-white rounded-2xl shadow-xl p-5 border-t-4 border-green-500">

        <h3 class="font-bold mb-3 text-lg">Progres Level</h3>

        <!-- PROGRESS BAR -->
        <div class="mb-4">
            <div class="flex justify-between text-sm mb-1">
                <span>Penyelesaian</span>
                <span id="progress-percentage">0%</span>
            </div>

            <div class="w-full bg-gray-200 rounded-full h-3">
                <div id="progress-bar"
                     class="bg-green-500 h-3 rounded-full transition-all duration-500"
                     style="width:0%">
                </div>
            </div>
        </div>

        <!-- STEP LIST -->
        <div class="space-y-3">

            @foreach($material->steps as $index => $step)
            <div class="flex items-center gap-2">

                <div class="step-indicator w-8 h-8 rounded-full bg-gray-400 text-white flex items-center justify-center"
                     data-step="{{$index+1}}">
                    {{$index+1}}
                </div>

                <span class="text-xs font-semibold">
                    {{$step->title}}
                </span>

            </div>
            @endforeach
        </div>
    </div>
</div>
</div>
</div>
</div>

<script>
lucide.createIcons();

let current = 1;
const totalSteps = {{ $material->steps->count() }};
const totalQuiz = {{ $material->quizzes->count() }};

let answered = 0;
let score = 0; // hanya untuk skor quiz akhir (opsional tampil di result)

// ================================
// STEP NAVIGATION
// ================================

function nextSection(next){

    document.querySelectorAll('.content-section')
        .forEach(el => el.classList.remove('active'));

    if(next > totalSteps){

        document.getElementById('section-quiz')
            .classList.add('active');

        current = totalSteps + 1;

    } else {

        current = next;

        document.getElementById('section-'+next)
            .classList.add('active');
    }

    let percent = (current / (totalSteps + 1)) * 100;
    updateProgressBar(percent);

    updateProgressIndicator();
}

// ================================
// PROGRESS SIDEBAR
// ================================

function updateProgressIndicator(){
    document.querySelectorAll('.step-indicator')
        .forEach((el,i)=>{
            el.classList.remove('active');
            if(i+1 === current){
                el.classList.add('active');
            }
        });
}

function updateProgressBar(percent){
    document.getElementById('progress-bar').style.width = percent + "%";
    document.getElementById('progress-percentage').innerText =
        Math.round(percent) + "%";
}

// ================================
// QUIZ SYSTEM
// ================================

function checkAnswer(button, correct, selected){

    const parent = button.closest('.quiz-item');
    const buttons = parent.querySelectorAll('.option-btn');

    if(parent.classList.contains('answered')) return;

    parent.classList.add('answered');
    answered++;

    buttons.forEach(btn => btn.disabled = true);

    if(selected === correct){

        button.classList.add('bg-green-500','text-white');
        score += 1;

    } else {

        button.classList.add('bg-red-500','text-white');

        buttons.forEach(btn => {
            if(btn.innerText.trim().startsWith(correct)){
                btn.classList.add('bg-green-500','text-white');
            }
        });
    }

    // Progress quiz bertahap
    let quizProgress = ((current) / (totalSteps + 1)) * 100;
    let extra = (answered / totalQuiz) * (100 - quizProgress);
    updateProgressBar(quizProgress + extra);

    if(answered === totalQuiz){

        updateProgressBar(100);

        document.getElementById('final-score').innerText = score;
        document.getElementById('quiz-result').classList.remove('hidden');
    }
}

// INIT
updateProgressIndicator();
updateProgressBar( (1 / (totalSteps + 1)) * 100 );

</script>
</body>
</html>
