<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePictureRequest;
use App\Models\Site;
use App\Models\StorePicture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class StorePictureController extends Controller {
    public function index(Request $request) {
        $storePictures = StorePicture::with('site')
            ->when($request->filled('search'), function($q) use ($request) {
                $term = trim((string)$request->input('search'));
                $q->where(function($sub) use ($term) {
                    $sub->where('description','like',"%{$term}%")
                        ->orWhere('notes','like',"%{$term}%")
                        ->orWhereHas('site',fn($site) => $site->where('name','like',"%{$term}%"));
                });
            })->orderByDesc('id')->paginate(10)->withQueryString();
        return view('backend.store_pictures.index',compact('storePictures'));
    }
    public function create() {
        return view('backend.store_pictures.create',['sites'=>Site::orderBy('name')->get()]);
    }
    public function store(StorePictureRequest $request) {
        $data = $request->validated();
        $data['picture'] = $request->file('picture')->store('store-pictures','public');
        $item = StorePicture::create($data);
        return redirect()->route('store-pictures.show',$item)->with('success','Site picture uploaded successfully.');
    }
    public function show(StorePicture $store_picture) {
        $store_picture->load('site');
        return view('backend.store_pictures.show',['item'=>$store_picture]);
    }
    public function edit(StorePicture $store_picture) {
        return view('backend.store_pictures.edit',['storePicture'=>$store_picture,'sites'=>Site::orderBy('name')->get()]);
    }
    public function update(StorePictureRequest $request, StorePicture $store_picture) {
        $data = $request->validated();
        if ($request->hasFile('picture')) {
            if ($store_picture->picture) Storage::disk('public')->delete($store_picture->picture);
            $data['picture'] = $request->file('picture')->store('store-pictures','public');
        } else unset($data['picture']);
        $store_picture->update($data);
        return redirect()->route('store-pictures.show',$store_picture)->with('success','Site picture updated successfully.');
    }
    public function destroy(StorePicture $store_picture) {
        if ($store_picture->picture) Storage::disk('public')->delete($store_picture->picture);
        $store_picture->delete();
        return redirect()->route('store-pictures.index')->with('success','Site picture deleted successfully.');
    }
}
