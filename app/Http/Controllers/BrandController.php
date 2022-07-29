<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrand;
use App\Http\Requests\UpdateBrand;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Traits\TableTrait;

class BrandController extends Controller
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
            $brands=Brand::filterBy($request->input('query'));
            return TableTrait::sortAndPaginate($request,$brands);
        }
        return view('marcas.index');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrand $request)
    {
        $brand= new Brand();
        $brand->fill($request->validated());
        $brand->save();
        return response()->json([
            'message' => 'Marca guardada correctamente'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrand $request, Brand $brand)
    {
        $brand->fill($request->validated());
        $brand->save();
        return response()->json([
            'message' => 'Marca actualizada correctamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return response()->json([
            'message' => 'Marca eliminada correctamente'
        ]);
    }

    public function json(){
        return Brand::all();
     }
}
