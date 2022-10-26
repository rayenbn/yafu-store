<?php

namespace App\Http\Controllers\Admin;

use App\Contactus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Illuminate\Support\Facades\Storage; //Laravel Filesystem

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('settings_access'), 403);

        $contactus = Contactus::first();

        return view('admin.contactus.index', compact('contactus'));
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

            $contactus_data = [
                'title'       => $request->input('title'),
                'address'       => $request->input('address'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
            ];

            $contactus = Contactus::create($contactus_data);

            return redirect()->route('admin.contactus.index', compact('contactus'));
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

        $contactus_data = [
            'title'       => $request->input('title'),
            'address'       => $request->input('address'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
        ];
        
        $contactus = Contactus::find($id);
        $contactus->update($contactus_data);

        return redirect()->route('admin.contactus.index', compact('contactus'));
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
