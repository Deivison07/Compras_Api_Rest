<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use Illuminate\Http\Request;

class TipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */

    public function __construct(Tipo $tipo){
        $this->tipo = $tipo;
    }

    public function index()
    {
        return response($this->tipo->all(),200);
    }

    public function store(Request $request)
    {
        $request->validate($this->tipo->roules(),$this->tipo->feedback());
        $obj = $this->tipo->create($request->all());
        return response($obj,201);
    }




    public function show($id){
    
        $obj = $this->tipo->find($id);
        if($obj===null){
            return response(['erro' => 'item não existe'],404);
        }
        return response($obj,200);
    }

    public function update(Request $request,  $id)
    {
        $obj = $this->tipo->find($id);
        if($obj===null){
            return response(['erro' => 'item não existe'],404);
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

        $request->validate($obj->roules(), $obj->feedback());

        $obj->fill($request->all());
        $obj->save();

        return response($obj,200);



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = $this->tipo->find($id);

        if($obj === null){
            return response(['erro'=>'item não existe'],404);
        }

        $obj->delete();
        return response(['msg'=>'objeto excluido com sucesso'],200);
    }
}
