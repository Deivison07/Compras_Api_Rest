<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{

    public function __construct(Produto $produto){
        $this->produto = $produto;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response($this->produto->all(),200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $request->validate($this->produto->roules(),$this->produto->feedback());
        $obj = $this->produto->create($request->all());
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

        $obj = $this->produto->find($id);

        if($obj === null){
            return response(['error'=>'objeto não cadastrado']);
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
        $obj = $this->produto->find($id);
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
        $obj = $this->produto->find($id);
        if($obj===null){
            return response(['error' => 'item não existe'],404);
        }
        $obj->delete();
        return response(['msg'=>'objeto excluido com sucesso'],200);
    }
}
