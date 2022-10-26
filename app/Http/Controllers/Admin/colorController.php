<?php

namespace App\Http\Controllers\Admin;

use App\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class colorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('product_access'), 403);

        $colors = Color::all();

        return view('admin.products.color.index', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(\Gate::allows('product_create'), 403);

        return view('admin.products.color.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_unless(\Gate::allows('product_create'), 403);

        $color_data = [
            'color_name' => $request->input('color_name'),
            'color_code' => $request->input('color_code'),
            'price' => $request->input('price'),
         ];

        $color = Color::create($color_data);

        return redirect()->route('admin.color.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Color $color)
    {
        abort_unless(\Gate::allows('product_show'), 403);

        return view('admin.products.category.show', compact('color'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Color $color)
    {
        abort_unless(\Gate::allows('product_edit'), 403);

        return view('admin.products.color.edit', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Color $color)
    {
        abort_unless(\Gate::allows('product_edit'), 403);
        $color_data = [
            'color_name' => $request->input('color_name'),
            'color_code' => $request->input('color_code'),
            'price' => $request->input('price'),
         ];

        $color->update($color_data);

        return redirect()->route('admin.color.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        abort_unless(\Gate::allows('product_delete'), 403);

        $color->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        Color::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}
