<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductPage;
use Image;
use Illuminate\Support\Facades\Storage; //Laravel Filesystem

class ProductPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('settings_access'), 403);

        $productpage = ProductPage::first();

        return view('admin.Product_page.index', compact('productpage'));
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
        if ($request->hasFile('banner')) {
            $image = $request->file('banner');
            
                //get filename with extension
            $filenamewithextension = $image->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $image->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;

            Storage::put('public/images/banners/'. $filenametostore, fopen($image, 'r+'));

            $path = $filenametostore;
        }

        $page_data = [
            'page_title'  => $request->input('page_title'),
            'banner' => $path,
         ];

         $productpage = ProductPage::create($page_data);

            return redirect()->route('admin.product-page.index', compact('productpage'));
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

        $productpage = ProductPage::find($id);
        $path = $productpage->banner;
        // Upload image
        
        if ($request->hasFile('banner')) {
            $image = $request->file('banner');
            
                //get filename with extension
            $filenamewithextension = $image->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $image->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;

            Storage::put('public/images/banners/'. $filenametostore, fopen($image, 'r+'));

            $path = $filenametostore;
        }

        $page_data = [
            'page_title'       => $request->input('page_title'),
            'banner' => $path,
         ];
         $productpage->update($page_data);

        return redirect()->route('admin.product-page.index', compact('productpage'));
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
