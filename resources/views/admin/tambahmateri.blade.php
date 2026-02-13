import React, { useState } from 'react';
import { 
  Save, Plus, Trash2, Layout, BookOpen, 
  Zap, Star, CheckCircle, Circle, Globe, 
  DollarSign, Activity, ChevronRight, Menu 
} from 'lucide-react';

export default function App() {
  // --- STATE UTAMA (DATABASE REPRESENTATION) ---
  const [activeTab, setActiveTab] = useState('edit'); // 'edit' atau 'preview'

  const [courseData, setCourseData] = useState({
    title: "Mengenal Kabel UTP",
    subtitle: "Unshielded Twisted Pair - Standar Kabel Jaringan Komputer",
    tag: "Pengenalan Kabel UTP",
    
    // Gamification & Leveling
    xpReward: 150,
    maxScore: 100,
    levelProgress: 0, // Persentase awal
    
    // Main Content
    sectionTitle: "Apa itu Kabel UTP?",
    description: "UTP (Unshielded Twisted Pair) adalah jenis kabel jaringan yang paling umum digunakan dalam instalasi jaringan komputer lokal (LAN). Kabel ini terdiri dari 4 pasang kabel tembaga yang saling dipilin (twisted) untuk mengurangi interferensi elektromagnetik.",
    
    // Dynamic Arrays
    characteristics: [
      "Tidak memiliki pelindung metal (unshielded) sehingga lebih fleksibel dan murah",
      "Menggunakan konektor RJ-45 untuk menghubungkan perangkat",
      "Panjang maksimal efektif 100 meter untuk menjaga kualitas sinyal",
      "Digunakan untuk koneksi Ethernet (10 Mbps hingga 10 Gbps)"
    ],
    
    steps: [
      { id: 1, title: "Memahami definisi UTP", status: "completed" },
      { id: 2, title: "Mengenali struktur kabel", status: "current" },
      { id: 3, title: "Memahami fungsi twisted pair", status: "locked" },
      { id: 4, title: "Mengetahui kategori kabel", status: "locked" },
      { id: 5, title: "Menyelesaikan kuis akhir", status: "locked" }
    ],
    
    infoCards: [
      { id: 1, title: "Aplikasi", text: "Jaringan LAN, telepon, CCTV, sistem keamanan", color: "bg-emerald-50", icon: "globe", borderColor: "border-emerald-200", iconColor: "text-emerald-500" },
      { id: 2, title: "Ekonomis", text: "Harga terjangkau dan mudah dipasang", color: "bg-orange-50", icon: "dollar", borderColor: "border-orange-200", iconColor: "text-orange-500" },
      { id: 3, title: "Performa", text: "Mendukung hingga 10 Gbps (Cat6a)", color: "bg-purple-50", icon: "activity", borderColor: "border-purple-200", iconColor: "text-purple-500" }
    ],

    nextLevelText: "Lanjutkan ke Struktur Kabel"
  });

  // --- HANDLERS (LOGIC ADMIN) ---

  const handleInputChange = (field, value) => {
    setCourseData({ ...courseData, [field]: value });
  };

  // Handler untuk List Karakteristik
  const addCharacteristic = () => {
    setCourseData({
      ...courseData,
      characteristics: [...courseData.characteristics, "Isi poin baru di sini..."]
    });
  };

  const updateCharacteristic = (index, value) => {
    const newChars = [...courseData.characteristics];
    newChars[index] = value;
    setCourseData({ ...courseData, characteristics: newChars });
  };

  const removeCharacteristic = (index) => {
    const newChars = courseData.characteristics.filter((_, i) => i !== index);
    setCourseData({ ...courseData, characteristics: newChars });
  };

  // Handler untuk Steps (Langkah Pembelajaran)
  const addStep = () => {
    const newId = courseData.steps.length + 1;
    setCourseData({
      ...courseData,
      steps: [...courseData.steps, { id: newId, title: "Langkah Baru", status: "locked" }]
    });
  };

  const updateStep = (index, field, value) => {
    const newSteps = [...courseData.steps];
    newSteps[index][field] = value;
    setCourseData({ ...courseData, steps: newSteps });
  };

  const removeStep = (index) => {
    const newSteps = courseData.steps.filter((_, i) => i !== index);
    setCourseData({ ...courseData, steps: newSteps });
  };

  // Helper Icon Render
  const getIcon = (name, className) => {
    switch(name) {
      case 'globe': return <Globe className={className} />;
      case 'dollar': return <DollarSign className={className} />;
      case 'activity': return <Activity className={className} />;
      default: return <Zap className={className} />;
    }
  };

  // --- RENDER COMPONENTS ---

  return (
    <div className="min-h-screen bg-gray-100 flex flex-col font-sans">
      
      {/* Navbar Admin */}
      <div className="bg-white shadow-sm border-b px-6 py-4 flex justify-between items-center sticky top-0 z-50">
        <div className="flex items-center gap-2">
          <div className="p-2 bg-indigo-600 rounded-lg">
            <Layout className="text-white w-5 h-5" />
          </div>
          <h1 className="text-xl font-bold text-gray-800">Cabelista <span className="text-sm font-normal text-gray-500">| Content Manager</span></h1>
        </div>
        
        <div className="flex bg-gray-100 p-1 rounded-lg">
          <button 
            onClick={() => setActiveTab('edit')}
            className={`px-4 py-2 rounded-md text-sm font-medium transition-all ${activeTab === 'edit' ? 'bg-white shadow text-indigo-600' : 'text-gray-500 hover:text-gray-700'}`}
          >
            Edit Materi
          </button>
          <button 
            onClick={() => setActiveTab('preview')}
            className={`px-4 py-2 rounded-md text-sm font-medium transition-all ${activeTab === 'preview' ? 'bg-white shadow text-indigo-600' : 'text-gray-500 hover:text-gray-700'}`}
          >
            Live Preview
          </button>
        </div>

        <button className="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition-colors shadow-sm">
          <Save size={18} />
          <span>Simpan Perubahan</span>
        </button>
      </div>

      <div className="flex-1 p-6 overflow-hidden">
        <div className="flex gap-6 h-full items-start">
          
          {/* --- PANEL KIRI: FORM ADMIN --- */}
          <div className={`flex-1 bg-white rounded-xl shadow-lg border border-gray-200 overflow-y-auto h-[calc(100vh-140px)] ${activeTab === 'preview' ? 'hidden md:block md:w-1/3 md:flex-none' : 'w-full'}`}>
            <div className="p-6 space-y-8">
              
              {/* 1. Pengaturan Dasar */}
              <section>
                <h3 className="text-sm uppercase tracking-wider text-gray-500 font-bold mb-4 flex items-center gap-2">
                  <BookOpen size={16} /> Header & Gamifikasi
                </h3>
                <div className="space-y-4">
                  <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1">Judul Materi</label>
                    <input type="text" value={courseData.title} onChange={(e) => handleInputChange('title', e.target.value)} className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 outline-none" />
                  </div>
                  <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1">Sub-Judul</label>
                    <input type="text" value={courseData.subtitle} onChange={(e) => handleInputChange('subtitle', e.target.value)} className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 outline-none" />
                  </div>
                  <div className="grid grid-cols-2 gap-4">
                    <div>
                      <label className="block text-sm font-medium text-gray-700 mb-1">XP Reward</label>
                      <input type="number" value={courseData.xpReward} onChange={(e) => handleInputChange('xpReward', e.target.value)} className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-500 outline-none" />
                    </div>
                    <div>
                      <label className="block text-sm font-medium text-gray-700 mb-1">Max Skor</label>
                      <input type="number" value={courseData.maxScore} onChange={(e) => handleInputChange('maxScore', e.target.value)} className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none" />
                    </div>
                  </div>
                </div>
              </section>

              <hr className="border-gray-100" />

              {/* 2. Konten Utama */}
              <section>
                <h3 className="text-sm uppercase tracking-wider text-gray-500 font-bold mb-4 flex items-center gap-2">
                  <Menu size={16} /> Konten & Karakteristik
                </h3>
                <div className="space-y-4">
                  <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1">Judul Seksi (Biru)</label>
                    <input type="text" value={courseData.sectionTitle} onChange={(e) => handleInputChange('sectionTitle', e.target.value)} className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 outline-none" />
                  </div>
                  <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1">Deskripsi Utama</label>
                    <textarea rows={4} value={courseData.description} onChange={(e) => handleInputChange('description', e.target.value)} className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 outline-none resize-none" />
                  </div>
                  
                  {/* Dynamic List */}
                  <div>
                    <label className="block text-sm font-medium text-gray-700 mb-2">Poin Karakteristik</label>
                    <div className="space-y-2">
                      {courseData.characteristics.map((char, index) => (
                        <div key={index} className="flex gap-2">
                          <input 
                            type="text" 
                            value={char} 
                            onChange={(e) => updateCharacteristic(index, e.target.value)}
                            className="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-1 focus:ring-indigo-500 outline-none"
                          />
                          <button onClick={() => removeCharacteristic(index)} className="p-2 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg">
                            <Trash2 size={16} />
                          </button>
                        </div>
                      ))}
                      <button onClick={addCharacteristic} className="w-full py-2 border border-dashed border-indigo-300 text-indigo-600 rounded-lg text-sm font-medium hover:bg-indigo-50 flex items-center justify-center gap-1">
                        <Plus size={14} /> Tambah Poin
                      </button>
                    </div>
                  </div>
                </div>
              </section>

              <hr className="border-gray-100" />

              {/* 3. Langkah Pembelajaran */}
              <section>
                <h3 className="text-sm uppercase tracking-wider text-gray-500 font-bold mb-4 flex items-center gap-2">
                  <CheckCircle size={16} /> Langkah Pembelajaran (Sidebar)
                </h3>
                <div className="space-y-3">
                  {courseData.steps.map((step, index) => (
                    <div key={index} className="p-3 bg-gray-50 rounded-lg border border-gray-200">
                      <div className="flex justify-between items-start mb-2">
                        <span className="bg-gray-200 text-gray-600 text-xs font-bold px-2 py-0.5 rounded">Step {step.id}</span>
                        <button onClick={() => removeStep(index)} className="text-red-400 hover:text-red-600"><Trash2 size={14} /></button>
                      </div>
                      <div className="space-y-2">
                        <input 
                          type="text" 
                          value={step.title} 
                          onChange={(e) => updateStep(index, 'title', e.target.value)}
                          className="w-full border border-gray-300 rounded px-2 py-1 text-sm"
                          placeholder="Judul langkah"
                        />
                        <select 
                          value={step.status} 
                          onChange={(e) => updateStep(index, 'status', e.target.value)}
                          className="w-full border border-gray-300 rounded px-2 py-1 text-sm bg-white"
                        >
                          <option value="locked">Terkunci (Locked)</option>
                          <option value="current">Sedang Dikerjakan (Current)</option>
                          <option value="completed">Selesai (Completed)</option>
                        </select>
                      </div>
                    </div>
                  ))}
                  <button onClick={addStep} className="w-full py-2 border border-dashed border-indigo-300 text-indigo-600 rounded-lg text-sm font-medium hover:bg-indigo-50 flex items-center justify-center gap-1">
                    <Plus size={14} /> Tambah Langkah
                  </button>
                </div>
              </section>

            </div>
          </div>

          {/* --- PANEL KANAN: LIVE PREVIEW (Tampilan Siswa) --- */}
          <div className={`flex-1 overflow-y-auto h-[calc(100vh-140px)] ${activeTab === 'edit' ? 'hidden md:block' : 'block'}`}>
            <div className="max-w-6xl mx-auto">
              {/* Header Bar */}
              <div className="bg-white p-4 rounded-xl shadow-sm mb-6 flex flex-col md:flex-row justify-between items-center gap-4">
                <div className="flex items-center gap-3">
                  <div className="w-10 h-10 rounded-full border-2 border-orange-400 flex items-center justify-center">
                    <div className="w-6 h-6 border-2 border-orange-400 rounded-full border-t-transparent animate-spin-slow" />
                  </div> 
                  <span className="font-bold text-gray-700 tracking-wide">CABELISTA</span>
                </div>
                
                <div className="flex gap-4">
                  {/* XP Widget */}
                  <div className="bg-orange-500 text-white rounded-lg px-4 py-2 flex items-center gap-3 shadow-md min-w-[140px]">
                    <Zap className="fill-white" size={20} />
                    <div>
                      <div className="text-xs font-medium text-orange-100">XP Points</div>
                      <div className="text-xl font-bold leading-none">{courseData.xpReward}</div>
                    </div>
                  </div>
                  {/* Score Widget */}
                  <div className="bg-indigo-500 text-white rounded-lg px-4 py-2 flex items-center gap-3 shadow-md min-w-[140px]">
                    <Star className="fill-white" size={20} />
                    <div>
                      <div className="text-xs font-medium text-indigo-100">Skor Total</div>
                      <div className="text-xl font-bold leading-none">0/{courseData.maxScore}</div>
                    </div>
                  </div>
                </div>
              </div>

              <div className="flex flex-col lg:flex-row gap-6">
                
                {/* --- CONTENT AREA (Left Column) --- */}
                <div className="flex-1 space-y-6">
                  
                  {/* Main Card */}
                  <div className="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div className="p-8 text-center border-b border-gray-100">
                      <span className="inline-block px-4 py-1 rounded-full bg-blue-100 text-blue-600 text-sm font-semibold mb-4">
                        {courseData.tag}
                      </span>
                      <h2 className="text-3xl font-bold text-indigo-600 mb-2">{courseData.title}</h2>
                      <p className="text-gray-500">{courseData.subtitle}</p>
                    </div>

                    <div className="p-8">
                      {/* Blue Info Box */}
                      <div className="bg-blue-50 rounded-xl p-6 border border-blue-100 mb-6">
                        <div className="flex gap-4">
                          <div className="bg-blue-500 rounded-lg p-3 h-fit text-white shadow-md">
                            <BookOpen size={24} />
                          </div>
                          <div>
                            <h3 className="text-xl font-bold text-indigo-900 mb-2">{courseData.sectionTitle}</h3>
                            <div className="text-gray-700 leading-relaxed mb-4">
                              <p><span className="font-bold text-gray-900">UTP (Unshielded Twisted Pair)</span> {courseData.description.replace('UTP (Unshielded Twisted Pair)', '')}</p>
                            </div>
                            
                            <div className="mt-4">
                              <h4 className="font-bold text-gray-800 text-sm mb-3">Karakteristik Utama:</h4>
                              <ul className="space-y-2">
                                {courseData.characteristics.map((char, i) => (
                                  <li key={i} className="flex items-start gap-2 text-gray-600 text-sm">
                                    <CheckCircle size={16} className="text-blue-500 mt-0.5 flex-shrink-0" />
                                    <span>{char}</span>
                                  </li>
                                ))}
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  {/* Info Cards Grid */}
                  <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                    {courseData.infoCards.map((card) => (
                      <div key={card.id} className={`${card.color} ${card.borderColor} border rounded-xl p-5 hover:shadow-md transition-shadow`}>
                        <div className="mb-3">
                          {getIcon(card.icon, `w-8 h-8 ${card.iconColor}`)}
                        </div>
                        <h4 className={`font-bold text-gray-800 mb-1`}>{card.title}</h4>
                        <p className="text-xs text-gray-600 leading-relaxed">{card.text}</p>
                      </div>
                    ))}
                  </div>

                  {/* Next Button */}
                  <button className="w-full bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-4 rounded-xl shadow-lg shadow-indigo-200 transition-all flex items-center justify-center gap-2 group">
                    {courseData.nextLevelText}
                    <ChevronRight className="group-hover:translate-x-1 transition-transform" />
                  </button>

                </div>

                {/* --- SIDEBAR (Right Column) --- */}
                <div className="w-full lg:w-80 flex-shrink-0">
                  <div className="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-6">
                    <div className="mb-6">
                      <h3 className="font-bold text-gray-800 flex items-center gap-2 mb-2">
                        <Activity size={18} className="text-green-500" /> Progres Level
                      </h3>
                      <div className="flex justify-between text-xs text-gray-500 mb-1">
                        <span>Penyelesaian</span>
                        <span>{courseData.levelProgress}%</span>
                      </div>
                      <div className="w-full bg-gray-100 rounded-full h-2.5">
                        <div className="bg-green-500 h-2.5 rounded-full" style={{ width: `${courseData.levelProgress}%` }}></div>
                      </div>
                    </div>

                    <div>
                      <h4 className="text-sm font-semibold text-gray-500 mb-4">Langkah Pembelajaran:</h4>
                      <div className="relative space-y-0">
                        {/* Vertical Line Connector */}
                        <div className="absolute left-[15px] top-2 bottom-6 w-0.5 bg-gray-200 z-0"></div>

                        {courseData.steps.map((step) => (
                          <div key={step.id} className="relative z-10 flex items-start gap-3 pb-6 last:pb-0 group cursor-pointer">
                            <div className={`
                              w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold border-2 transition-colors
                              ${step.status === 'completed' ? 'bg-indigo-600 border-indigo-600 text-white' : ''}
                              ${step.status === 'current' ? 'bg-white border-indigo-600 text-indigo-600 shadow-[0_0_0_3px_rgba(79,70,229,0.2)]' : ''}
                              ${step.status === 'locked' ? 'bg-gray-800 border-gray-800 text-white' : ''}
                            `}>
                              {step.status === 'completed' ? <CheckCircle size={14} /> : step.id}
                            </div>
                            <div className="pt-1">
                              <p className={`text-sm font-semibold ${step.status === 'locked' ? 'text-gray-400' : 'text-gray-800 group-hover:text-indigo-600'}`}>
                                {step.title}
                              </p>
                              <p className="text-[10px] text-gray-400 uppercase tracking-wide mt-0.5">
                                {step.status === 'current' ? 'Sedang aktif' : step.status}
                              </p>
                            </div>
                          </div>
                        ))}
                      </div>
                    </div>

                    {/* Hint Box */}
                    <div className="mt-6 bg-blue-50 border border-blue-100 rounded-lg p-3 flex gap-2">
                      <div className="text-yellow-500 mt-0.5">💡</div>
                      <p className="text-xs text-gray-600">
                        <span className="font-bold">Tips:</span> Klik pada bagian kabel dan jawab kuis untuk melanjutkan!
                      </p>
                    </div>

                  </div>
                </div>

              </div>
              <br/><br/>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}