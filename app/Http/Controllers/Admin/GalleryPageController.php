<?php

namespace App\Http\Controllers\Admin;

use App\Gallery;
use App\GalleryPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Illuminate\Support\Facades\Storage; //Laravel Filesystem

class GalleryPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_unless(\Gate::allows('gallery_access'), 403);
        
        $this->validateInput($request);

        // Upload image
        if ($request->hasFile('banner')) {
            $image = $request->file('banner');
            $filenamewithextension = $image->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;
            Storage::put('public/images/banners/'. $filenametostore, fopen($image, 'r+'));
            $path = $filenametostore;
            $gallerypage = new GalleryPage();
            $gallerypage->banner = $path;
            $gallerypage->page_title = $request->page_title;
            $gallerypage->save();
        }
        
        return redirect()->route('admin.gallery.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        abort_unless(\Gate::allows('gallery_access'), 403);
        
        $this->validateInput($request);

        $gallerypage = GalleryPage::findOrFail($id);
        $path = $gallerypage->banner;
      
        // Upload image
        if ($request->hasFile('banner')) {
            $image = $request->file('banner');
            $filenamewithextension = $image->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;
            Storage::put('public/images/banners/'. $filenametostore, fopen($image, 'r+'));
            $path = $filenametostore;
        }
            $gallerypage->page_title = $request->page_title;
            $gallerypage->banner = $path;
            $gallerypage->save();
        
        return redirect()->route('admin.gallery.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function validateInput($request) {
        $this->validate($request, [
            'banner' => 'required'
        ]);
    }
}
