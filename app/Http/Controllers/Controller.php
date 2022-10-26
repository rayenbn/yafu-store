<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Category;
use App\Contactus;
use App\Footer;
use App\GlobalSetting;
use App\Partner;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function categories()
    {
        // $categories = Category::all();
        $categories = Category::with('children')
            ->whereNull('parent_category_id')
            ->get();
        return $categories;
    }

    public static function footer_categories()
    {
        $categories = Category::orderBy('position', 'asc')->take(6)->get();
        return $categories;
    }

    public static function partners()
    {
        $partners = Partner::all();
        return $partners;
    }

    public static function footer()
    {
        $footer = Footer::first();
        return $footer;
    }

    public static function contact()
    {
        $contact = Contactus::select('email', 'phone')->first();
        return $contact;
    }

    public static function cartItems()
    {
        if (auth()->check()){
            $items = Cart::where([['created_by', '=', auth()->id()],['submited', 0]])->count();
        }else{
            $items = 0;
        }
        return $items;
    }
    // public static function getin_touch()
    // {
    //     $getin_touch = Footer::select('getin_touch_title', 'getin_touch_desc')->first();
    //     return $getin_touch;
    // }

    public static function global_settings()
    {
        $global_settings = GlobalSetting::select('logo','footer_logo','logo_title', 'meta_title')->first();
        return $global_settings;
    }
}
