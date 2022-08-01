<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

    public function __construct( Cliente $cliente){
        $this->cliente = $cliente;
    }

    public function index(){
        return response($this->cliente->with('compra')->get(),200);
    }

    public function store(Request $request){

        $request->validate($this->cliente->roules(),$this->cliente->feedback());

        $obj = $this->cliente->create($request->all());
        return response($obj,201);
    }

    public function show($id){

        $obj = $this->cliente->with('compra')->find($id);
        if($obj === null){
            return response(['error'=>'item não existe'],404);
        }
        return response($obj,200);
    }

    public function update(Request $request, $id){

        $obj = $this->cliente->find($id);  
        if($obj===null){
            return response(['error' => 'item não existe'],404);
        }

        if ($request->method() === 'PATCH'){
            $regrasDinamicas = array();

            foreach($obj->roules() as $input => $regras){

                if(array_key_exists($input,$request->all())){
                    $regrasDinamicas[$input] = $regras;
                }
            }
            $request->validate( $regrasDinamicas, $obj->feedback());
        }
        else{
            $request->validate( $obj->roules(), $obj->feedback());
        }

        $obj->fill($request->all());
        $obj->save();

        return response($obj,200);
    }

    public function destroy($id){


        $obj = $this->cliente->find($id);
        if($obj===null){
            return response(['error' => 'item não existe'],404);
        }

        $obj->delete();
        return response(['msg'=>'item excluido com sucesso']);
    }

}
