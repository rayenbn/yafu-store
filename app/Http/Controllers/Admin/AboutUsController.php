<?php

namespace App\Http\Controllers\Admin;

use App\Aboutus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Illuminate\Support\Facades\Storage; //Laravel Filesystem

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('settings_access'), 403);

        $aboutus = Aboutus::first();

        return view('admin.aboutus.index', compact('aboutus'));
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
        abort_unless(\Gate::allows('settings_access'), 403);
        
        // Upload image

        if ($request->hasFile('sec_one_img')) {
            $image = $request->file('sec_one_img');
            $filenamewithextension = $image->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;
            Storage::put('public/images/banners/'. $filenametostore, fopen($image, 'r+'));
            $pathimg = $filenametostore;
        }else{
            $pathimg = null;
        }

        $aboutus = new Aboutus;
        $aboutus->sec_one_title = $request->sec_one_title;
        $aboutus->sec_one_text = $request->sec_one_text;
        $aboutus->sec_one_img = $pathimg;
        $aboutus->save();

        return redirect()->route('admin.aboutus.index', compact('aboutus'));
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
        abort_unless(\Gate::allows('settings_access'), 403);

        $aboutus = Aboutus::find($id);
        $pathimg = $aboutus->sec_one_img;
        
       // Upload image
     
       if ($request->hasFile('sec_one_img')) {
           $image = $request->file('sec_one_img');
           $filenamewithextension = $image->getClientOriginalName();
           $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
           $extension = $image->getClientOriginalExtension();
           $filenametostore = $filename.'_'.uniqid().'.'.$extension;
           Storage::put('public/images/banners/'. $filenametostore, fopen($image, 'r+'));
           $pathimg = $filenametostore;
       }

        $aboutus->sec_one_title = $request->sec_one_title;
        $aboutus->sec_one_text = $request->sec_one_text;
        $aboutus->sec_one_img = $pathimg;
        $aboutus->save();

        return redirect()->route('admin.aboutus.index', compact('aboutus'));
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
}
