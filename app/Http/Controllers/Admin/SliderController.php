<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage; //Laravel Filesystem
use Response;
use App\Slider;
use Session;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.settings.slider.slider', compact('sliders'));
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
        $this->validateInput($request);

        // Upload image
        $path = null;
        if ($request->hasFile('picture')) {
            $image = $request->file('picture');
            
                //get filename with extension
            $filenamewithextension = $image->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $image->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;

            Storage::put('public/sliders/'. $filenametostore, fopen($image, 'r+'));
            //Storage::put('public/products/thumbnail/'. $filenametostore, fopen($image, 'r+'));

            //Resize image here
            // $thumbnailpath = public_path('storage/products/thumbnail/'.$filenametostore);
            // $img = Image::make($thumbnailpath)->resize(470, 346)->save($thumbnailpath);
            $path = $filenametostore;
        }
        // Upload image
        $slider_data = [
            'picture'         => $path,
            'title'       => $request->input('title'),
            'subtitle'       => $request->input('subtitle'),
            'link'       => $request->input('link'),
            
         ];

        Slider::create($slider_data);
        Session::flash('success', 'Slider saved successfully');
        return redirect()->intended('admin/slider');
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
        $slider = Slider::find($id);
       
        if ($slider == null) {
            return redirect()->intended('admin/slider');
        }
        return view('admin.settings.slider.edit', compact('slider'));
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
        $slider = Slider::findOrFail($id);
        $path = $slider->picture ?? null;

        if ($request->hasFile('picture')) {
            $image = $request->file('picture');
            
                //get filename with extension
            $filenamewithextension = $image->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $image->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;

            Storage::put('public/sliders/'. $filenametostore, fopen($image, 'r+'));
            $path = $filenametostore;
            // $slider_data['picture'] = $path;
        }

        $slider_data = [
            'picture'         => $path,
            'title'       => $request->input('title'),
            'subtitle'       => $request->input('subtitle'),
            'link'       => $request->input('link'),
         ];

        $slider->update($slider_data);

        Session::flash('success', 'Slider saved successfully');
        return redirect()->intended('admin/slider');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();

        return back();
    }

    private function validateInput($request) {
        $this->validate($request, [
            'picture' => 'required'
        ]);
    }
 
    private function createQueryInput($keys, $request) {
        $queryInput = [];
        for($i = 0; $i < sizeof($keys); $i++) {
            $key = $keys[$i];
            $queryInput[$key] = $request[$key];
        }
        return $queryInput;
    }
}
