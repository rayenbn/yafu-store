<?php

namespace App\Http\Controllers\Frontend;

use App\Blog;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image; //Intervention Image
use Illuminate\Support\Facades\Storage; //Laravel Filesystem

class blogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::orderBy('updated_at', 'DESC')->paginate(10);
        $popular_blogs = Blog::orderBy('views', 'DESC')->take(5)->get();
        $categories = Category::where('status', 1)->get();
        return view('frontend.blogs', compact('blogs','categories','popular_blogs'));
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        $blog->increment('views');
        $categories = Category::where('status', 1)->get();
        $popular_blogs = Blog::orderBy('views', 'DESC')->take(5)->get();
        return view('frontend.blog_single', compact('blog','popular_blogs','categories'));
    }

}

