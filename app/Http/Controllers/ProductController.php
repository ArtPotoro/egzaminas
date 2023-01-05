<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Restoran;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('products.index',['products'=>Product::all()]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('products.edit', ['restorans'=>Restoran::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
//        Product::create($request->all());
//        return redirect()->route('products.index');
        $product = new Product();
        if($request->file('picture')!=null) {

            $foto = $request->file('picture');

            $fotoname = $request->id . '_' . rand() . '.' . $foto->extension();
            $foto->storeAs('images',$fotoname);
            $product->picture=$fotoname;
            $path = $request->file('picture')->store('images/', 'public');
            $file = $request->file('file');
            $name = time().$file->getClientOriginalName();
            $file->move('images/client', $name);

            $data = array_merge(['photo' => "images/client/{$name}"], $request->all());

        }

        $product->name=$request->name;
        $product->quantity=$request->quantity;

        $product->price=$request->price;
        $product->restoran_id=$request->restoran_id;

        $product->save();

        return redirect()->route('products.index', $product->restoran_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Product $product)
    {
        return view('products.edit',[
           'product'=>$product,
           'restorans'=>Restoran::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Product $product)
    {
        if (Gate::denies('edit')){
            return redirect()->route('products.index');
        }
        $product->fill($request->all());
        $product->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        return redirect()->route('products.index');
    }

    public function restoranProducts($id)
    {
        return view('products.index',['products'=>Product::where('restoran_id',$id)->get()]);
    }
}
