<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategory;
use App\Http\Requests\UpdateCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\TableTrait;


class CategoryController extends Controller
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
            $categories=Category::with('parent')->filterBy($request->input('query'));
            return TableTrait::sortAndPaginate($request,$categories);
        }
        return view('categorias.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategory $request)
    {
        $category= new Category();
        $category->fill($request->validated());
        $category->save();
        return response()->json([
            'message' => 'Categoría guardada correctamente'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategory $request, Category $category)
    {
        $category->fill($request->validated());
        $category->save();
        return response()->json([
            'message' => 'Categoria actualizada correctamente'
        ]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            'message' => 'Categoria eliminada correctamente'
        ]);
    }

    public function json(){
        return Category::all();
    }
}
