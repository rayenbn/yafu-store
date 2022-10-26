<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCategoryRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Category;
use Illuminate\Support\Str;
use Image;
use Illuminate\Support\Facades\Storage; //Laravel Filesystem

class categoryController extends Controller
{
    public function index()
    {
        abort_unless(\Gate::allows('product_access'), 403);

        // $categories = Category::all();

        $categories = Category::with('children')
            ->whereNull('parent_category_id')
            ->get();
            // dd($categories);
        return view('admin.products.category.index', compact('categories'));
    }

    public function create()
    {
        abort_unless(\Gate::allows('product_create'), 403);
        $categories = Category::with('children')
            ->whereNull('parent_category_id')
            ->get();
        return view('admin.products.category.create', compact('categories'));
    }

    public function store(StoreCategoryRequest $request)
    {
        abort_unless(\Gate::allows('product_create'), 403);

        // dd($request->filled('parent_cat'));
        $path = null;
         if ($request->hasFile('category_image')) {
             $image = $request->file('category_image');
                 //get filename with extension
             $filenamewithextension = $image->getClientOriginalName();
             //get filename without extension
             $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
             //get file extension
             $extension = $image->getClientOriginalExtension();
             //filename to store
             $filenametostore = $filename.'_'.uniqid().'.'.$extension;
             Storage::put('public/images/category_image/'. $filenametostore, fopen($image, 'r+'));
             $path = $filenametostore;
         }

        $category_data = [
            'category_name'       => $request->input('category_name'),
            'order'               => $request->input('order'),
            'category_image'      => $path,
            'slug'                => Str::slug($request->input('category_name'))
            
        ];

        if ($request->has('status')){
            $category_data['status'] = $request->input('status');
         }
         
        if ($request->filled('cat_parent')){// cat_parent for checkbox input have or doesnt have parent?
            $category_data['has_parent'] =  true;
        }
        
        if ($request->filled('cat_parent') && $request->filled('parent_cat')){// parent_cat is the id of the category if it has a parent
            $category_data['parent_category_id'] =  $request->input('parent_cat');
        }
        
        if ($request->filled('showInHomePage')){// cat_parent for checkbox input if it shows on the home page?
            $category_data['show_in_home_page'] =  true;
        }
        if ($request->filled('showInHomePage') && $request->filled('position')){
            $category_data['position'] =  $request->input('position');
            $category_data['subtitle'] =  $request->input('subtitle');
            $category_data['desc'] =  $request->input('desc');
        }
        $categories = Category::create($category_data);
        return redirect()->route('admin.category.index');
    }

    public function edit(Category $category)
    {
        abort_unless(\Gate::allows('product_edit'), 403);
        $categories = Category::with('children')
        ->whereNull('parent_category_id')
        ->get();
        return view('admin.products.category.edit', compact('category', 'categories'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        abort_unless(\Gate::allows('product_edit'), 403);
        $path = $category->category_image;
        // Upload image
        
        if ($request->hasFile('category_image')) {
            $image = $request->file('category_image');
                //get filename with extension
            $filenamewithextension = $image->getClientOriginalName();
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            //get file extension
            $extension = $image->getClientOriginalExtension();
            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;
            Storage::put('public/images/category_image/'. $filenametostore, fopen($image, 'r+'));

            $path = $filenametostore;
        }

        $category_data = [
            'category_name'       => $request->input('category_name'),
            'order'               => $request->input('order'),
            'category_image'      => $path,
            'slug'                => Str::slug($request->input('category_name'))
         ];

         if ($request->has('status')){
            $category_data['status'] = $request->input('status');
         }

        if ($request->filled('cat_parent')){// cat_parent for checkbox inout have or doesnt have parent?
            $category_data['has_parent'] =  true;
        }else{
            $category_data['has_parent'] =  false;

        }
        
        if ($request->filled('cat_parent') && $request->filled('parent_cat')){// parent_cat is the id of the category if it has a parent
            $category_data['parent_category_id'] =  $request->input('parent_cat');
        }else{
            $category_data['parent_category_id'] =  null;
        }

        if ($request->filled('showInHomePage')){// cat_parent for checkbox input if it shows on the home page?
            $category_data['show_in_home_page'] =  true;
        }else{
            $category_data['show_in_home_page'] =  false;

        }
        if ($request->filled('showInHomePage') && $request->filled('position')){
            $category_data['position'] =  $request->input('position');
            $category_data['subtitle'] =  $request->input('subtitle');
            $category_data['desc'] =  $request->input('desc');
        }else{
            $category_data['position'] =  100;
        }

        $category->update($category_data);

        return redirect()->route('admin.category.index');
    }

    public function show(Category $category)
    {
        abort_unless(\Gate::allows('product_show'), 403);

        return view('admin.products.category.show', compact('category'));
    }

    public function destroy(Category $category)
    {
        abort_unless(\Gate::allows('product_delete'), 403);

        $category->delete();

        return back();
    }

    public function massDestroy(MassDestroyCategoryRequest $request)
    {
        Category::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}
