<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cidade = Cidade::with('grupo')->get();
        return $cidade;
    }

    public function store(Request $request)
    {
        $mensagens = [
            'required' => ':Attribute é obrigatório!',
        ];

        $validator = Validator::make($request->all(),[
            'grupos_id' => 'required',
            'titulo' => 'required',
        ], $mensagens);

        if($validator->fails())
        {
            return response()->json([
                'status' =>400,
                'errors' => $validator->getMessageBag(),
            ]);
        }else{
             $cidade = new Cidade;
             $cidade ->grupos_id = $request->input('grupos_id');
             $cidade ->titulo = $request->input('titulo');
             $cidade ->save();
             return response()->json([
                'status' =>200,
                'message' => 'Cidade Adicionado com Sucesso',
             ]);

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cidade  $Cidade
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cidade = Cidade::find($id);
        if($cidade)
        {
            return response()->json([
                'status'=>200,
                'Cidade'=> $cidade,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'Nenhum Cidade Encontrado'
            ]);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cidade  $Cidade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mensagens = [
            'required' => ':Attribute é obrigatório!',
        ];
        
        $validator = Validator::make($request->all(), [
            'grupos_id' => 'required|max:191',
            'titulo' => 'required|max:191',
        ], $mensagens);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors' => $validator->getMessageBag(),
            ]);
        }
        else
        {
            $cidade = Cidade::find($id);
            if($cidade)
            {
                $cidade ->grupos_id = $request->input('grupos_id');
                $cidade ->titulo = $request->input('titulo');
                $cidade->update();
                return response()->json([
                    'status'=>200,
                    'message'=>'Cidade Atualizado com Sucesso.'
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>404,
                    'message'=>'Nenhum Cidade Encontrado'
                ]);
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cidade  $Cidade
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cidade = Cidade::find($id);
        if($cidade)
        {
            $cidade->delete();
            return response()->json([
                'status'=>200,
                'message'=>'Cidade Deletado com Sucesso.'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'Nenhum Cidade Encontrado.'
            ]);
        }
    }
}