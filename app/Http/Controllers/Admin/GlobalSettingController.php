<?php

namespace App\Http\Controllers\Admin;

use App\GlobalSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image; //Intervention Image
use Illuminate\Support\Facades\Storage; //Laravel Filesystem

class GlobalSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('settings_access'), 403);

        $global_settings = GlobalSetting::first();

        return view('admin.settings.general-settings.index', compact('global_settings'));
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
        $path = null;
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            
                //get filename with extension
            $filenamewithextension = $image->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $image->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;

            Storage::put('public/logo/'. $filenametostore, fopen($image, 'r+'));
            Storage::put('public/logo/thumbnail/'. $filenametostore, fopen($image, 'r+'));

            //Resize image here
            $thumbnailpath = 'storage/logo/thumbnail/'.$filenametostore;

            $img = Image::make($thumbnailpath)->resize(60, 60)->save($thumbnailpath);
            $path = $filenametostore;
        }
       
        $footerpath = null;
        if ($request->hasFile('footer_logo')) {
            $image = $request->file('footer_logo');
            
                //get filename with extension
            $filenamewithextension = $image->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $image->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;

            Storage::put('public/logo/'. $filenametostore, fopen($image, 'r+'));
            Storage::put('public/logo/thumbnail/'. $filenametostore, fopen($image, 'r+'));

            //Resize image here
            $thumbnailpath = 'storage/logo/thumbnail/'.$filenametostore;

            $img = Image::make($thumbnailpath)->resize(60, 60)->save($thumbnailpath);
            $footerpath = $filenametostore;
        }

        $global_settings = new GlobalSetting;
        $global_settings->logo          = $path;
        $global_settings->footer_logo          = $footerpath;
        $global_settings->logo_title    = $request->logo_title;
        $global_settings->meta_title    = $request->meta_title;
        $global_settings->save();

        return redirect()->intended('admin/global-settings');
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
        // Upload image
        $path = null;
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            
                //get filename with extension
            $filenamewithextension = $image->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $image->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;

            Storage::put('public/logo/'. $filenametostore, fopen($image, 'r+'));
            Storage::put('public/logo/thumbnail/'. $filenametostore, fopen($image, 'r+'));

            //Resize image here
            $thumbnailpath = 'storage/logo/thumbnail/'.$filenametostore;

            $img = Image::make($thumbnailpath)->resize(60, 60)->save($thumbnailpath);
            $path = $filenametostore;
        }else {
            $global_settings = GlobalSetting::find($id);
            $path = $global_settings->logo;
        }
       // Upload image
       $footerpath = null;
       if ($request->hasFile('footer_logo')) {
           $image = $request->file('footer_logo');
           
               //get filename with extension
           $filenamewithextension = $image->getClientOriginalName();

           //get filename without extension
           $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

           //get file extension
           $extension = $image->getClientOriginalExtension();

           //filename to store
           $filenametostore = $filename.'_'.uniqid().'.'.$extension;

           Storage::put('public/logo/'. $filenametostore, fopen($image, 'r+'));
           Storage::put('public/logo/thumbnail/'. $filenametostore, fopen($image, 'r+'));

           //Resize image here
           $thumbnailpath = 'storage/logo/thumbnail/'.$filenametostore;

           $img = Image::make($thumbnailpath)->resize(60, 60)->save($thumbnailpath);
           $footerpath = $filenametostore;
       }else {
           $global_settings = GlobalSetting::find($id);
           $footerpath = $global_settings->footer_logo;
       }
        $global_settings = GlobalSetting::find($id);
        $global_settings->logo          = $path;
        $global_settings->footer_logo          = $footerpath;
        $global_settings->logo_title    = $request->logo_title;
        $global_settings->meta_title    = $request->meta_title;
        $global_settings->save();

        return redirect()->intended('admin/global-settings');
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
