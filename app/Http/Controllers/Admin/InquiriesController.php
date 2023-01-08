<?php

namespace App\Http\Controllers\Admin;

use App\CompanyInquiry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PrivateInquiry;
use App\Warranty;

class InquiriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('inquiries_access'), 403);

        $inquiries = collect();
        $companyInquiries = CompanyInquiry::orderBy('created_at', 'asc')->get();
        $privateInquiries = PrivateInquiry::orderBy('created_at', 'asc')->get();
        
        foreach ($privateInquiries as $private)
            $inquiries->push($private);

        foreach ($companyInquiries as $company)
            $inquiries->push($company);

        $inquiries = $inquiries->sortByDesc(function ($inquiry, $key) {
            return $inquiry['created_at'];
        });        
        $inquiries->values()->all();

        return view('admin.inquiries.index', compact('inquiries'));
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
