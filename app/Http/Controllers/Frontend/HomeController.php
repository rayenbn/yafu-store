<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\HomePage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductPage;
use App\Slider;
use App\Warranty;
use App;
use App\Blog;
use App\Gallery;
use App\Mail\SampleInquiry;
use App\Newsletter;
use App\PrivacyPolicy;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $home_page = HomePage::first();
        $sliders = Slider::all();
        $categories = Category::orderBy('position', 'asc')->take(6)->get()->toarray();
        $blogs = Blog::orderBy('created_at', 'asc')->take(3)->get();
        $galleries = Gallery::select('picture')->get();
        $products = Product::where('status', 1)->inRandomOrder()->limit(8)->get();
       
        return view('frontend.index', compact('home_page','sliders', 'categories','products','blogs','categories','galleries'));
    }

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function warranty()
    {
        $warranty = Warranty::first();
        return view('frontend.warranty', compact('warranty'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function privacy()
    {
        $privacy = PrivacyPolicy::first();
        return view('frontend.privacy_policy', compact('privacy'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function search(Request $request)
    {
    //   $products = FacadesDB::table('products')
    //     ->where('name', 'LIKE', "%{$request->product_name}%")
    //     ->where('deleted_at', null)
    //     ->paginate(12);
        // dd($products);
        $products = Product::whereTranslationLike('name', "%{$request->product_name}%", \App::getLocale())
        ->where('deleted_at', null)
        ->paginate(12);

        $categories = Category::all();
        return view('frontend.products', compact('products', 'categories'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function newsletterSubscribe(Request $request)
    {

        Newsletter::create(['email' => $request->newsletter_email]);
        return back()->with('success', 'Thanks for subscribing to Yafu Store newsletter', 'succes');
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function inquirySample(Request $request)
    {
dd($request->all());
        $this->validate($request, [
            'name'         => 'required',
            'email'        => 'required|email',
            'address'         => 'required',
            'phone'         => 'required',
            'product'      => 'required',
        ]);
        $data = array(
            'name'         => $request->name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'address'      => $request->address,
            'product'      => $request->product
        );

        Mail::to('info@pufflex.net')->send(new SampleInquiry($data));
        return back()->with('success', 'We have successfully  received your inquiry');

        Newsletter::create(['email' => $request->newsletter_email]);
    }
}
