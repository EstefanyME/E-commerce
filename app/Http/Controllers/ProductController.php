<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProduct;
use App\Http\Requests\UpdateProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\TableTrait;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        if($request->wantsJson()){
            $products=Product::with(['brand','category'])
                ->filterBy($request->input('query'));
            return TableTrait::sortAndPaginate($request,$products);
        }
        return view('productos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProduct $request)
    {
        $product= new Product();
        $product->fill($request->validated());
        $product->save();
        return response()->json([
            'message' => 'Producto guardado correctamente'
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProduct $request, $id)
    {
        $product=Product::findOrFail($id);
        $product->fill($request->validated());
        $product->save();
        return response()->json([
            'message' => 'Producto actualizado correctamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            'message' => 'Producto eliminado correctamente'
        ]);
    }

    public function json(){
        return Product::all();
     }
}
