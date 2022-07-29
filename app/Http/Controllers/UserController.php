<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\TableTrait;

class UserController extends Controller
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
            $users=User::filterBy($request->input('query'));
            return TableTrait::sortAndPaginate($request,$users);
        }
        return view('usuarios.index');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        $user= new User();
        $user->fill($request->validated());
        $user ->password =bcrypt($request->validated('password'));
        $user->save();
        return response()->json([
            'message' => 'Usuario guardado correctamente'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, $id)
    {
       $user=User::findOrFail($id);
        $user->fill($request->validated());
        if($request->password)$user ->password =bcrypt($request->validated('password'));
        $user->save();
        return response()->json([
            'message' => 'Usuario actualizado correctamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'message' => 'Usuario eliminado correctamente'
        ]);
    }

}
