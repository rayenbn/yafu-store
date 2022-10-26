<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image; //Intervention Image
use Illuminate\Support\Facades\Storage; //Laravel Filesystem
use App\Gallery;
use App\GalleryPage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Gallery::all();
        $gallerypage = GalleryPage::first();
        return view('admin.gallery.index', compact('galleries', 'gallerypage'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gallery.multiple_file_upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image_code = '';
        if ($request->hasFile('file')) {
            $images = $request->file('file');
            foreach($images as $image){
                    //get filename with extension
                $filenamewithextension = $image->getClientOriginalName();
    
                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                //get file extension
                $extension = $image->getClientOriginalExtension();
                //filename to store
                $filenametostore = $filename.'_'.uniqid().'.'.$extension;
                Storage::put('public/gallery/'. $filenametostore, fopen($image, 'r+'));
                Storage::put('public/gallery/thumbnail/'. $filenametostore, fopen($image, 'r+'));
    
                //Resize image here
                $thumbnailpath = public_path('storage/gallery/thumbnail/'.$filenametostore);
                $img = Image::make($thumbnailpath)->resize(null, 279, function($constraint) {
                    $constraint->aspectRatio();
                });
                // $img = Image::make($thumbnailpath)->resize(null, 279)->save($thumbnailpath);
                $img->save($thumbnailpath);
                $gallery = new Gallery;
                $gallery->picture = $filenametostore;
                $gallery->save();
                $image_code .= '<div class="col-md-3" style="margin-bottom:24px;"><img src="/storage/gallery/thumbnail/'.$filenametostore.'" class="img-thumbnail" /></div>';
            }

            $output = array(
                'success'  => 'Images uploaded successfully',
                'image'   => $image_code
            );
        }else{
            $output = array(
                'error'  => 'No images selected',
                'image'   => null
            );
        }
   
        return response()->json($output);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return back();
    }
}
