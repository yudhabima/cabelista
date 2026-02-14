<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materi; // Pastikan model diimport
use Intervention\Image\ImageManagerStatic as image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;




class MateriController extends Controller
{
    # Fungsi index
    public function index()
    {
        return view('admin.materi.materiadmin', [
            'materis' => Materi::orderBy('id', 'desc')->get()
        ]);
    }

    # Halaman create
    public function create()
    {
        return view('admin.materi.create');
    }

    # Fungsi store
    public function store(Request $request)
    {
      $rules =[
        'judul' => 'required',
        'image' =>'required|max: 1000|mimes:jpg,jpeg,png,webp',
        'desc'=>'required|min:20'
      ];

      $massage =[
        'judul.required' => 'wajib diisi!',
        'image.required' => 'wajib diisi!',
        'desc.required' => 'wajib diisi!',
      ];
      $this->validate($request,$rules,messages: $massage);
      
      #IMAGE
            $fileName =time() . '.' . $request->image->extension();
            $request->file('image')->storeAs('public/artikel',$fileName);

            $storage = "storage/content-artikel";
            $dom = new \DOMDocument();
            #MEMPERSINGKAT EROR
            libxml_use_internal_errors(true);
            $dom ->loadHTML ($request -> desc, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
            # Menghapus buffer kesalahan libxm?
            libxml_clear_errors();
      
      $image = $dom ->getElementsByTagName('img');

      foreach($image as $img){
        $src = $img ->getAttribute('src');
        if(preg_match('/data:imege/',$src)){
            preg_match('/data:image\/(?<mine>.?)\;/',$src, $groups);
            $minetype = $groups['mime'];
            $fileNameContent = uniqid();
            $fileNameContentRand = substr(md5($fileNameContent),6,6). '_' . time();
            $filePath = ("$storage/$fileNameContentRand.$minetype");
            $image = Image::make($src)->resize(1440,720)->encode($minetype,100)->save(public_path($filePath));
            $new_src =asset($filePath);
            $img -> removeAttribute('src');
            $img -> setAttribute('src', $new_src);
            $img -> setAttribute('class','img-responsive');

        }
      }

      Blog::create([
        'judul'=>$request->judul,
        'slug' => Str:: slug($request->judul,'_'),
        'image' =>$fileName,
        'desc'=>$dom->saveHTML(),
      ]);

      return redirect(route('blog'))->with('success','data berhasi disimpan');

    }

    # Halaman edit
    public function edit($id)
    {
        $materi = Materi:: find($id);
        return view('admin.materi.edit', [
            'materi' =>$materi
        ]);
    }

    # Fungsi update
    public function update(Request $request, $id)
    {
        $artikel = Blog::find($id);
        
        // Define validation rules
        $rules = [
            'judul' => 'required',
            'image' => 'nullable|max:1000|mimes:jpg,jpeg,png,webp', // image is optional, but if uploaded, it's validated
            'desc' => 'required|min:20',
        ];
        
        $messages = [
            'judul.required' => 'wajib diisi!',
            'image.required' => 'wajib diisi!',
            'desc.required' => 'wajib diisi!',
        ];
        
        $this->validate($request, $rules, $messages);
        
        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            // Store the new image
            $fileName = time() . '.' . $request->image->extension();
            $request->file('image')->storeAs('public/artikel', $fileName);
            $checkFileName = $fileName; // Assign the new file name
            
            // Delete the old image if it exists
            if (\File::exists(storage_path('app/public/artikel/' . $artikel->image))) {
                \File::delete(storage_path('app/public/artikel/' . $artikel->image));
            }
        } else {
            // Use the old image if no new image is uploaded
            $checkFileName = $request->old_image;
        }
    
        // Process the description (desc) for inline images if they exist
        $storage = "storage/content-artikel";
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($request->desc, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        libxml_clear_errors();
    
        $images = $dom->getElementsByTagName('img');
    
        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                // Handle base64 image
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimeType = $groups['mime'];
                $imageData = base64_decode(substr($src, strpos($src, ',') + 1));
                $fileNameContentRand = substr(md5(uniqid()), 0, 6) . '_' . time();
                $filePath = "$storage/$fileNameContentRand.$mimeType";
    
                // Save the image
                Image::make($imageData)
                    ->resize(1440, 720)
                    ->encode($mimeType, 100)
                    ->save(public_path($filePath));
    
                $newSrc = asset($filePath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $newSrc);
                $img->setAttribute('class', 'img-responsive');
            }
        }
    
        // Update the article record
        $artikel->update([
            'judul' => $request->judul,
            'image' => $checkFileName, // Save the new or old image
            'desc' => $dom->saveHTML(),
        ]);
    
        return redirect(route('blog'))->with('success', 'Data berhasil disimpan');
    }
    


    # Fungsi delete
    public function destroy($id)
    {
        $artikel =Blog::find($id);
            if (\File::exists(storage_path('app/public/artikel/' . $artikel->image))) {
                \File::delete(storage_path('app/public/artikel/' . $artikel->image));
            }
        $artikel->delete();
        
        return redirect(route('blog'))->with('success', 'Data berhasil dihapus');
    

    }
}
