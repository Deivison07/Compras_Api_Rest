<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;

class CompraController extends Controller
{

    public function __construct(Compra $compra){

        $this->compra = $compra;

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        return response($this->compra->with('cliente','produto')->get());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->compra->roules(),$this->compra->feedback());
        $obj = $this->compra->create($request->all());
        return response($obj,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $obj = $this->compra->with('cliente','produto')->find($id);

        if($obj == null){
            return response(['erro'=> 'item não existe'],404);
        }
        return response($obj,200);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $obj = $this->compra->find($id);
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
        $obj = $this->compra->find($id);

        if($obj == null){
            return response(['erro'=> 'item não existe'],404);
        }

        $obj->delete();
        return response(['msg'=>'item excluido com sucesso']);
    }
}
