<?php

namespace App\Http\Controllers\Frontend;

use App\Contactus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\QuoteMail;
use Illuminate\Support\Facades\Mail;
use SebastianBergmann\Environment\Console;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contactus = Contactus::first();
        return view('frontend.get-a-quote', compact('contactus'));
    }

    function sendQuote(Request $request)
    {
        $this->validate($request, [
            'name'         => 'required',
            'company'         => 'required',
            'phone'         => 'required',
            'email'        => 'required|email',
            'message'      => 'required',
        ]);
        $data = array(
            'name'         => $request->name,
            'company'        => $request->company,
            'email'        => $request->email,
            'phone'        => $request->phone,
            // 'interests'      => $request->interest,
            'message'      => $request->message,
            'reach'      => $request->reach,
            'hear'      => $request->hear
        );

        Mail::to('info@getlf.net')->send(new QuoteMail($data));
        return back()->with('success', 'We have Successfully received your Enquiry');

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
        //
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
