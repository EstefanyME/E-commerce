<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class CartController extends Controller
{
    public function index(){
        $cart = \Cart::getContent();
        $total = \Cart::getTotal();
        return view('cart', compact('cart' , 'total'));
    }
    public function add(Request $request){
        \Cart::add([
            'id' => $request->id, // inique row ID
            'name' => $request->name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'attributes' => []
        ]);
        /*$cart = [
            'product_id' => $request->product_id,
            'quantity'   => $request->quantity
        ];
        if($request->session()->exists('cart')){
            $old_cart= json_decode($request->session()->get('cart'), true);
            if($old_cart['product_id'] == $request->product_id){
                $cart['quantity'] = ($old_cart['quantity'] + $request->quantity);
                $request->session()->put('cart', json_encode($cart));
                return response()->json([
                    'message' => 'Producto actualizado al carrito ' .$cart['quantity']
                ]);
            }
        }else{
            $request->session()->put('cart', json_encode($cart));
        }*/
        
        return response()->json([
            'message' => 'Producto agregado al carrito'
        ]);
    }
}
