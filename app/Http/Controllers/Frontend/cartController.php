<?php

namespace App\Http\Controllers\Frontend;

use App\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class cartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Cart::where([['created_by', '=', auth()->id()],['submited', 0]])->get();
        $cartTotal = $items->sum('total');
        $cartPrice = $items->sum('price');
        return view('frontend.shoppingcart', compact('items','cartTotal','cartPrice'));
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
        $types= json_decode($request->prodtypes);
        $color= json_decode($request->prodcolor);
        $product = Product::findOrFail($request->id);
     
        $typesdesc = "";
        if ($color){
            $typesdesc .= '- '.$color->color_name. '('.$color->color_code.')'. "<br>";
        }

        $typesPrice = 0;
        if ($types){
            foreach ($types as $type)
            {
                $typesPrice += $type->price;
                $typesdesc .= '- '.$type->name.  "<br>";
            }
        }
        $totalPrice = (($product ? $product->price : 0) + ($types ? $typesPrice : 0)+ ($color ? $color->price : 0)) * 100;
        
        // dd($totalPrice);
        $data =[
            'prod_id' => $request->id,
            'prod_img' => $product->img,
            'prod_name' => $product->name,
            'prod_desc' => $typesdesc,
            'price' => (integer)$totalPrice,
            'total' => (integer)($totalPrice * (integer)$request->quantity),
            'qty' => (integer)$request->quantity,
            'created_by' => auth()->check() ? auth()->id() : csrf_token(),
            'logofile' => $request->logofile
        ];
        
        $cart = Cart::create($data);

        return redirect()->route('shoppingcart');
    }

    public function uploadlogo(Request $request)
    {
        $path = 'customersLogo/'. (\Auth::user() ? auth()->user()->name : 'anonymous');
        $pathToFile = $request->file('logofile')->store($path, 'public');

        return $pathToFile;
    }

    /**
     * Submit the order
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitOrder()
    {
        /** @var \Illuminate\Support\Collection $cart */
        $cart = collect();
        $products = Cart::where([['created_by', '=', (string)auth()->id()],['submited', '=', 0]]);
        $cart->put('products', $products);

        $totalQuantity = $cart->reduce(function ($carry, $item) {
            return $carry + $item->count();
        }, 0);
        
        Mail::to('myrayenemail@fgufr.com')->send($mailer = new \App\Mail\OrderSubmit(auth()->user()));

        $invoiceNumber = $mailer->getInvoiceNumber();
        $now = now();

        $cart->map(function ($items) use ($now) {
            if ($items->count() === 0) return false;

            $items->update([
                'submited' => 1,
                'saved_date' => $now,
                // 'usenow' => 0
            ]);
        });
        
        session()->flash('success', 'Your order has been successfully sent!');
        session()->flash('invoiceNumber', $invoiceNumber);

       

        return redirect()->route('ordersuccess');
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
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return back();
    }
}
