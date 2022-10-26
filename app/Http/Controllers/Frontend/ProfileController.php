<?php

namespace App\Http\Controllers\Frontend;

use App\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class ProfileController extends Controller
{
    public function __construct(){      
        // $this->middleware(function ($request, $next) {      
        //     if(auth()->user()->hasRole('frontuser')){
        //         return redirect()->route('home')->withFlashMessage('You are not authorized to access that page.')->withFlashType('warning');
        //     }
        //     return $next($request);
        // });
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(auth()->user()->roles->first()->title);
        $user = auth()->user();
        $orders = Cart::select('invoice_number')->where([['created_by', '=', auth()->user()->id],['submited','=', 1]])->groupBy('invoice_number')->get();

        return view('frontend.profile', compact('user', 'orders'));
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getOrders()
    {
        
        return view('frontend.profile', compact('user'));
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
        //
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
        $user = User::findOrFail(auth()->user()->id);
        
        $user->update([
            'name' => $request->name,
            'company_name' => $request->company_name,
            'phone' => $request->phoneCode . $request->phone,
            'position' => $request->position,
            'country' => $request->country,
            'countryCode' => $request->countryCode,
            'address' => $request->address,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        return redirect()->route('my-profile.index', ['#tab-1'])->with('success', 'saved');
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
