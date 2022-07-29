<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClient;
use App\Http\Requests\UpdateClient;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Traits\TableTrait;

class ClientController extends Controller
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
            $clients=Client::filterBy($request->input('query'));
            return TableTrait::sortAndPaginate($request,$clients);
        }
        return view('clientes.index');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClient $request)
    {
        $client= new Client();
        $client->fill($request->validated());
        $client ->password =bcrypt($request->validated('password'));
        $client->save();
        return response()->json([
            'message' => 'Cliente guardado correctamente'
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClient $request, Client $client)
    {
        $client->fill($request->validated());
        if($request->password)$client->password =bcrypt($request->validated('password'));
        $client->save();
        return response()->json([
            'message' => 'Cliente actualizado correctamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return response()->json([
            'message' => 'Cliente eliminado correctamente'
        ]);
    }


}
