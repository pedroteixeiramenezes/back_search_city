<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class GrupoController extends Controller
{
    
    private $grupo;

    public function __construct(Grupo $grupo)
    {
        $this->grupo = $grupo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->grupo->all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mensagens = [
            'required' => ':Attribute é obrigatório!',
            'titulo.max' => 'Titulo tem que ser maior do que 2 caracteres'
        ];

        $validator = Validator::make($request->all(),[
            'titulo' => 'required|min:2',
        ], $mensagens);

        if($validator->fails())
        {
            return response()->json([
                'status' =>400,
                'errors' => $validator->getMessageBag(),
            ]);
        }else{
             $grupo = new Grupo;
             $grupo ->titulo = $request->input('titulo');
             $grupo ->save();
             return response()->json([
                'status' =>200,
                'message' => 'Grupo Adicionado com Sucesso',
             ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idGrupo)
    {
        $grupo = Grupo::find($idGrupo);
        if($grupo)
        {
            return response()->json([
                'status'=>200,
                'Grupo'=> $grupo,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'Nenhum Grupo Encontrado'
            ]);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mensagens = [
            'required' => ':Attribute é obrigatório!',
            'titulo.min' => 'Titulo tem que ser maior do que 2 caracteres'
        ];

        $validator = Validator::make($request->all(),[
            'titulo' => 'required|min:2',
        ], $mensagens);

        if($validator->fails())
        {
            return response()->json([
                'status' =>400,
                'errors' => $validator->getMessageBag(),
            ]);
        }else
        {
            $grupo = Grupo::find($id);
            if($grupo)
            {
             $grupo ->titulo = $request->input('titulo');
             $grupo->update();
                return response()->json([
                    'status'=>200,
                    'message'=>'Grupo Atualizado com Sucesso.'
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>404,
                    'message'=>'Nenhum Grupo Encontrado'
                ]);
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grupo = Grupo::find($id);
        if($grupo)
        {
            $grupo->delete();
            return response()->json([
                'status'=>200,
                'message'=>'Grupo Deletado com Sucesso.'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'Nenhum Grupo Encontrado.'
            ]);
        }
    }
}
