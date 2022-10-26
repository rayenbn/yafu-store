<?php

namespace App\Http\Controllers\Admin;

use App\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image; //Intervention Image
use Illuminate\Support\Facades\Storage; //Laravel Filesystem
use Auth;

class blogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('blog_access'), 403);

        $blogs = Blog::all();

        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(\Gate::allows('blog_create'), 403);

        return view('admin.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_unless(\Gate::allows('blog_create'), 403);
        $path = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
                //get filename with extension
            $filenamewithextension = $image->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $image->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;

            Storage::put('public/blogs/'. $filenametostore, fopen($image, 'r+'));
            Storage::put('public/blogs/thumbnail/'. $filenametostore, fopen($image, 'r+'));

            //Resize image here
            $thumbnailpath = public_path('storage/blogs/thumbnail/'.$filenametostore);
          
            // $img = Image::make($thumbnailpath)->resize(700, 350)->save($thumbnailpath);
            $img = Image::make($thumbnailpath)->resize(null, 385, function ($constraint) {
                $constraint->aspectRatio();
            });
            $path = $filenametostore;
        }
        Blog::create([
            'image' => $path,
            'title' => $request->title,
            'text' => $request->text,
            'created_by' => Auth::check() ? Auth::user()->name : 'anonymouse',
        ]);
        return redirect()->route('admin.blogs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        abort_unless(\Gate::allows('blog_show'), 403);

        return view('admin.blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        abort_unless(\Gate::allows('blog_edit'), 403);

        return view('admin.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        abort_unless(\Gate::allows('blog_edit'), 403);
        // Upload image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
                //get filename with extension
            $filenamewithextension = $image->getClientOriginalName();
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            //get file extension
            $extension = $image->getClientOriginalExtension();
            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;
            Storage::put('public/blogs/'. $filenametostore, fopen($image, 'r+'));
            Storage::put('public/blogs/thumbnail/'. $filenametostore, fopen($image, 'r+'));

            //Resize image here
            $thumbnailpath = public_path('storage/blogs/thumbnail/'.$filenametostore);
            // $img = Image::make($thumbnailpath)->resize(null, 350)->save($thumbnailpath);
            $img = Image::make($thumbnailpath)->resize(null, 385, function ($constraint) {
                $constraint->aspectRatio();
            });
            $path = $filenametostore;
        }else {
            $path = $blog->image;
        }
        $blog->update([
            'image' => $path,
            'title' => $request->title,
            'text' => $request->text,
            'created_by' => Auth::check() ? Auth::user()->name : 'anonymouse',
        ]);

        return redirect()->route('admin.blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        abort_unless(\Gate::allows('blog_delete'), 403);

        $blog->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        Blog::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}

