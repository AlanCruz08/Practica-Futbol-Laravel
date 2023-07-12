<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\futbolista;
use Illuminate\Support\Facades\Validator;


class FutbolistaController extends Controller
{
    protected $reglas = [
        'nombre'=>'required|string|min:3|max:50',
        'ap_paterno'=>'required|string|min:3|max:50',
        'ap_materno'=>'required|string|min:3|max:50',
        'alias'=>'required|string|min:3|max:50',
        'no_camiseta'=>'required|integer|min:1|max:99',
        'equipo_id'=>'required|integer|min:1|max:99',
    ];
    public function index()
    {
$futbolistas = futbolista::all();
return response()->json([
    'msg' => 'Futbolistas obtenidos correctamente',
    'data' => $futbolistas,
    'status' => 201
], 201);

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
        $validacion=Validator::make($request->all(),$this->reglas);
        //Si falla la validacion retornara a un error
        if($validacion->fails())
            return response()->json
            ([
                'msg' => 'Datos incorrectos',
                'data' => $validacion->errors(),
                'status' => 422
            ],422);
        
        if(!$request->bearerToken())
            
                return response()->json([
                    'msg'=>'Token requerido',
                    'status'=>401
                ],401);
            
        $persona = futbolista::create($validacion->validated());

        if ($persona->save())
        return response()->json([
            'msg'=>'Persona creada',
            'persona'=>$persona,
            'status'=>201
        ],201);
        return response()->json([
            'msg'=>'Error al crear la persona',
            'status'=>422
        ],422);
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, futbolista $futbolista)
    {
        $validacion=Validator::make($request->all(),$this->reglas);
        //Si falla la validacion retornara a un error
        if($validacion->fails())
            return response()->json
            ([
                'msg' => 'Datos incorrectos',
                'data' => $validacion->errors(),
                'status' => 422
            ],422);
        
        if(!$request->bearerToken())
            
                return response()->json([
                    'msg'=>'Token requerido',
                    'status'=>401
                ],401);
            
        $futbolista->update($validacion->validated());

        if ($futbolista->save())
        return response()->json([
            'msg'=>'Futbolista actualizado',
            'futbolista'=>$futbolista,
            'status'=>201
        ],201);
        return response()->json([
            'msg'=>'Error al actualizar el futbolista',
            'status'=>422
        ],422);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(futbolista $futbolista,Request $request)
    {
        if(!$request->bearerToken())
        return response()->json([
            'msg'=>'Token requerido',
            'status'=>401
        ],401);
    if($futbolista->delete())
        return response()->json([
            'msg'=>'Futbolista eliminado',
            'status'=>201
        ],201);
    return response()->json([
        'msg'=>'Error al eliminar el futbolista',
        'status'=>422
    ],422);

    }
}
