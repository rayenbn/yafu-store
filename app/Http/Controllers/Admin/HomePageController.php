<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\HomePage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Illuminate\Support\Facades\Storage; //Laravel Filesystem

class HomePageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('settings_access'), 403);

        $homepage = HomePage::first();
        $categories = Category::all();
        return view('admin.home_page.index', compact('homepage', 'categories'));
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
        $sec2_image1 = null;
        if ($request->hasFile('sec2_image1')) {
            $image = $request->file('sec2_image1');
            $filenamewithextension = $image->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;
            Storage::put('public/products/'. $filenametostore, fopen($image, 'r+'));
            $sec2_image1 = $filenametostore;
        }
         // Upload image
         $sec2_image2 = null;
         if ($request->hasFile('sec2_image2')) {
             $image = $request->file('sec2_image2');
             $filenamewithextension = $image->getClientOriginalName();
             $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
             $extension = $image->getClientOriginalExtension();
             $filenametostore = $filename.'_'.uniqid().'.'.$extension;
             Storage::put('public/products/'. $filenametostore, fopen($image, 'r+'));
             $sec2_image2 = $filenametostore;
         }
         $sec2_image3 = null;
         if ($request->hasFile('sec2_image3')) {
             $image = $request->file('sec2_image3');
             $filenamewithextension = $image->getClientOriginalName();
             $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
             $extension = $image->getClientOriginalExtension();
             $filenametostore = $filename.'_'.uniqid().'.'.$extension;
             Storage::put('public/products/'. $filenametostore, fopen($image, 'r+'));
             $sec2_image3 = $filenametostore;
         }

         $page_data = [
            'sec2_image1' => $sec2_image1,
            'sec2_text1' => $request->input('sec2_text1'),
            'sec2_desc1' => $request->input('sec2_desc1'),
            'sec2_link1' => $request->input('sec2_link1'),
            'sec2_image2' => $sec2_image2,
            'sec2_text2' => $request->input('sec2_text2'),
            'sec2_desc2' => $request->input('sec2_desc2'),
            'sec2_link2' => $request->input('sec2_link2'),
            'sec2_image3' => $sec2_image3,
            'sec2_text3' => $request->input('sec2_text3'),
            'sec2_desc3' => $request->input('sec2_desc3'),
            'sec2_link3' => $request->input('sec2_link3'),
            'sec3_title' => $request->input('sec3_title'),
            'sec3_subtitle' => $request->input('sec3_subtitle'),
            
        ];

            $homepage = HomePage::create($page_data);

            return redirect()->route('admin.home-page.index', compact('homepage'));
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

        $homepage = HomePage::find($id);
       
        $banner = $homepage->banner;
        $sec2_image1 = $homepage->sec2_image1;
        $sec2_image2 = $homepage->sec2_image2;
        if ($request->hasFile('banner')) {
            $image = $request->file('banner');
            $filenamewithextension = $image->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;
            Storage::put('public/banners/'. $filenametostore, fopen($image, 'r+'));
            $banner = $filenametostore;
        }
        if ($request->hasFile('sec2_image1')) {
            $image = $request->file('sec2_image1');
            $filenamewithextension = $image->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;
            Storage::put('public/products/'. $filenametostore, fopen($image, 'r+'));
            $sec2_image1 = $filenametostore;
        }
        if ($request->hasFile('sec2_image2')) {
            $image = $request->file('sec2_image2');
            $filenamewithextension = $image->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;
            Storage::put('public/products/'. $filenametostore, fopen($image, 'r+'));
            $sec2_image2 = $filenametostore;
        }

        $page_data = [
            'en' => [
                'sec1_title'     => $request->input('en_sec1_title'),
                'sec2_title1'    => $request->input('en_sec2_title1'),
                'sec2_subtitle1' => $request->input('en_sec2_subtitle1'),
                'sec2_title2'    =>$request->input('en_sec2_title2'),
                'sec2_subtitle2' => $request->input('en_sec2_subtitle2'),
                'sec3_title'     => $request->input('en_sec3_title'),
                
            ],
            'es' => [
                'sec1_title'     => $request->input('es_sec1_title'),
                'sec2_title1'    => $request->input('es_sec2_title1'),
                'sec2_subtitle1' => $request->input('es_sec2_subtitle1'),
                'sec2_title2'    =>$request->input('es_sec2_title2'),
                'sec2_subtitle2' => $request->input('es_sec2_subtitle2'),
                'sec3_title'     => $request->input('es_sec3_title'),
            ],
            'sec1_cat_id'   => $request->input('sec1_cat_id'),
            'sec3_cat_id'   => $request->input('sec3_cat_id'),
            'banner'        => $banner,
            'sec2_image1'   => $sec2_image1,
            'sec2_image2'   => $sec2_image2,
            'sec2_cat_id1'   => $request->input('sec2_cat_id1'),
            'sec2_cat_id2'   => $request->input('sec2_cat_id2'),
            
        ];
        $homepage->update($page_data);

        return redirect()->route('admin.home-page.index', compact('homepage'));

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
