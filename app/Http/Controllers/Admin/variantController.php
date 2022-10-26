<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Type;
use App\Variant;

class variantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('product_access'), 403);

        $variants = Variant::all();
        $types = Type::all();

        return view('admin.products.variants.index', compact('variants', 'types'));
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
        // dd($request->all());
        abort_unless(\Gate::allows('product_create'), 403);

        Variant::create([
            'name' => $request->name,
            'price' =>  $request->price * 100,
            'type_id' => $request->type,
        ]);

        return redirect()->route('admin.variant.index');
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
    public function edit(Variant $variant)
    {
        abort_unless(\Gate::allows('product_edit'), 403);
        return view('admin.products.variants.edit_variant', compact('variant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Variant $variant)
    {
        abort_unless(\Gate::allows('product_edit'), 403);

        $variant_data = [
            'name' => $request->input('name'),
            'price' => $request->input('price') * 100,
         ];

        $variant->update($variant_data);

        return redirect()->route('admin.variant.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Variant $variant)
    {
        abort_unless(\Gate::allows('product_delete'), 403);

        $variant->delete();

        return back();
    }
}
