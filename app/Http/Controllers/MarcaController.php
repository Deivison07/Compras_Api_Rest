<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MarcaController extends Controller
{


    public function __construct(Marca $marca)
    {
        $this->marca = $marca;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response($this->marca->with('produtos')->get(),200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $request->validate($this->marca->roules(),$this->marca->feedback());
        
        $imagem = $request->logo_marca;
        $imagem_urn = $imagem->store('imagens','public');

        $obj = $this->marca->create($request->all());
        $obj->fill(['logo_marca'=>$imagem_urn]);
        $obj->save();
        return response($obj,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $obj = $this->marca->with('produtos')->find($id);

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
        $obj = $this->marca->find($id);
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

        if(array_key_exists('imagem_marca',$request->all())){

            Storage::disk('public')->delete($obj->logo_marca);
            $imagem = $request->logo_marca;
            $imagem_urn = $imagem->store('imagens','public');

            $obj->logo_marca = $imagem_urn;
            $obj->save();
        }
        return $obj;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = $this->marca->find($id);
        if($obj === null){
            return response(['error'=>'item não existe'],404);
        }

        Storage::disk('public')->delete($obj->logo_marca);
        $obj->delete();
        return response(['msg'=> 'excluido com sucesso']);

    }
}
