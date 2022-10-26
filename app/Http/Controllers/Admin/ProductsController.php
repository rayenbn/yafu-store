<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Image; //Intervention Image
use Illuminate\Support\Facades\Storage; //Laravel Filesystem
use App\Product;
use App\Category;
use App\Color;
use App\ProductsImage;
use App\Type;
use GuzzleHttp\Psr7\Request;

class ProductsController extends Controller
{
    public function index()
    {
        abort_unless(\Gate::allows('product_access'), 403);

        $products = Product::all();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        abort_unless(\Gate::allows('product_create'), 403);
        $categories = Category::all();
        $colors = Color::all();
        $types = Type::all();
        return view('admin.products.create', compact('categories', 'colors', 'types'));
    }

    public function store(StoreProductRequest $request)
    {
        abort_unless(\Gate::allows('product_create'), 403);
        
        // Upload image
        $path = null;
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            
                //get filename with extension
            $filenamewithextension = $image->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $image->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;

            Storage::put('public/products/'. $filenametostore, fopen($image, 'r+'));
            Storage::put('public/products/thumbnail/'. $filenametostore, fopen($image, 'r+'));

            //Resize image here
            $thumbnailpath = 'storage/products/thumbnail/'.$filenametostore;
            $img = Image::make($thumbnailpath)->resize(470, 600)->save($thumbnailpath);
            $path = $filenametostore;
        }

        $video_path = null;
         // Upload video
         if ($request->hasFile('video')) {
            $image = $request->file('video');
            //get filename with extension
            $filenamewithextension = $image->getClientOriginalName();
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            //get file extension
            $extension = $image->getClientOriginalExtension();
            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;
            Storage::put('public/products/'. $filenametostore, fopen($image, 'r+'));
            $video_path = $filenametostore;
        }

        $product_data = [
            'price'         => $request->input('price'),
            'discount_price'   => $request->input('discount_price'),
            'availability'  => $request->input('availability'),
            'img'         => $path,
            'video'         => $video_path,
            'name'       => $request->input('name'),
            'description'       => $request->input('description'),
            'color_code' => $request->input('color_code')
         ];

         if ($request->has('status')){
            $product_data['status'] = $request->input('status');
         }
         if ($request->has('haslogo')){
            $product_data['haslogo'] = (integer) $request->haslogo;
            $product_data['logoprice'] = $request->logoprice * 100;
         }
        
        $product = Product::create($product_data);
       
        $product->categories()->sync($request->categories);
        $product->colors()->sync($request->colors);
        $product->types()->sync($request->types);
        
        if ($request->hasFile('img')) {
            ProductsImage::create([
                'productImages' => $path,
                'product_id' => $product->id,
            ]);
        }

        if ($request->hasFile('productImages')) {
            $images = $request->file('productImages');
            foreach($images as $image){
                    //get filename with extension
                $filenamewithextension = $image->getClientOriginalName();
                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                //get file extension
                $extension = $image->getClientOriginalExtension();
                //filename to store
                $filenametostore = $filename.'_'.uniqid().'.'.$extension;
                Storage::put('public/products/'. $filenametostore, fopen($image, 'r+'));
                Storage::put('public/products/thumbnail/'. $filenametostore, fopen($image, 'r+'));
                //Resize image here
                $thumbnailpath = 'storage/products/thumbnail/'.$filenametostore;
                $img = Image::make($thumbnailpath)->resize(470, 600)->save($thumbnailpath);
                
                ProductsImage::create([
                    'productImages' => $filenametostore,
                    'product_id' => $product->id,
                ]);
            }
        }
        
        return redirect()->route('admin.products.index');
    }

    public function edit(Product $product)
    {
        abort_unless(\Gate::allows('product_edit'), 403);
        $categories = Category::all();
        $colors = Color::all();
        $types = Type::all();
        $productImages = $product->images()->get();
        return view('admin.products.edit', compact('product', 'categories', 'productImages', 'colors','types'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        // dd( $request->all());
        abort_unless(\Gate::allows('product_edit'), 403);
        // Upload image
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            //get filename with extension
            $filenamewithextension = $image->getClientOriginalName();
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            //get file extension
            $extension = $image->getClientOriginalExtension();
            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;
            Storage::put('public/products/'. $filenametostore, fopen($image, 'r+'));
            Storage::put('public/products/thumbnail/'. $filenametostore, fopen($image, 'r+'));
            //Resize image here
            $thumbnailpath = 'storage/products/thumbnail/'.$filenametostore;
            $img = Image::make($thumbnailpath)->resize(470, 488)->save($thumbnailpath);
            $path = $filenametostore;
        }else {
            $product = Product::find($id);
            $path = $product->img;
        }

        // Upload video
        if ($request->hasFile('video')) {
            $image = $request->file('video');
            //get filename with extension
            $filenamewithextension = $image->getClientOriginalName();
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            //get file extension
            $extension = $image->getClientOriginalExtension();
            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;
            Storage::put('public/products/'. $filenametostore, fopen($image, 'r+'));
            $video_path = $filenametostore;
        }else {
            $product = Product::find($id);
            $video_path = $product->video;
        }

        $product_data = [
            'price'         => $request->input('price'),
            'discount_price'   => $request->input('discount_price'),
            'availability'  => $request->input('availability'),
            'img'         => $path,
            'video'         => $video_path,
            'name'       => $request->input('name'),
            'description'       => $request->input('description'),
            'color_code' => $request->input('color_code')
         ];
        
         if ($request->has('status')){
            $product_data['status'] = $request->input('status');
         }
         
         if ($request->has('haslogo')){
            $product_data['haslogo'] = (integer) $request->haslogo;
            $product_data['logoprice'] = $request->logoprice * 100;
         }else{
            $product_data['haslogo'] = 0;
            $product_data['logoprice'] = 0;
         }

        $product = Product::find($id);
        $product->update($product_data);
        $product->categories()->sync($request->categories);
        $product->colors()->sync($request->colors);
        $product->types()->sync($request->types);

        if ($request->hasFile('img')) {
            ProductsImage::create([
                'productImages' => $path,
                'product_id' => $product->id,
            ]);
        }
        
        if ($request->hasFile('productImages')) {
            $images = $request->file('productImages');
            foreach($images as $image){
                    //get filename with extension
                $filenamewithextension = $image->getClientOriginalName();
                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                //get file extension
                $extension = $image->getClientOriginalExtension();
                //filename to store
                $filenametostore = $filename.'_'.uniqid().'.'.$extension;
                Storage::put('public/products/'. $filenametostore, fopen($image, 'r+'));
                Storage::put('public/products/thumbnail/'. $filenametostore, fopen($image, 'r+'));
                //Resize image here
                $thumbnailpath = 'storage/products/thumbnail/'.$filenametostore;
                $img = Image::make($thumbnailpath)->resize(470, 488)->save($thumbnailpath);
               
                ProductsImage::create([
                    'productImages' => $filenametostore,
                    'product_id' => $product->id,
                ]);
            }
        }
        return redirect()->route('admin.products.index');
    }

    public function show(Product $product)
    {
        abort_unless(\Gate::allows('product_show'), 403);

        return view('admin.products.show', compact('product'));
    }

    public function destroy(Product $product)
    {
        abort_unless(\Gate::allows('product_delete'), 403);

        $product->delete();

        return back();
    }
    

    public function deleteImage(ProductsImage $image)
    {
        abort_unless(\Gate::allows('product_delete'), 403);

        $image->delete();

        return response(null, 204);
    }

    public function massDestroy(MassDestroyProductRequest $request)
    {
        Product::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}
