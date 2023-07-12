<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\equipo;
use Illuminate\Support\Facades\Validator;


class EquipoController extends Controller
{
    
    protected $reglas = [
        'nombre' => 'required|string|max:255',
        'dir_deportivo' => 'required|string|max:255',
       
    ];
    public function index()
    {
        $equipos = equipo::all();
        return response()->json([
            'msg' => 'Equipos obtenidos correctamente',
            'data' => $equipos,
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
        //Se valida la solicitud
        $validator = Validator::make($request->all(), $this->reglas);
        //Si falla la validación
        if ($validator->fails()) 
            return response()->json([
                'msg' => 'Error de validación',
                'data' => $validator->errors(),
                'status' => 422
            ], 422);
        
        //En caso de no tener el token retorna un error 401
        if(!$request->bearerToken())
            return response()->json([
                'msg' => 'No autorizado',
                'data' => null,
                'status' => 401
            ], 401);
        
        //Se crea el equipo
        $equipo = equipo::create($request->all());
        //Se retorna el equipo creado
        return response()->json([
            'msg' => 'Equipo creado correctamente',
            'data' => $equipo,
            'status' => 201
        ], 201);
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
    public function update(Request $request, equipo $equipo)
    {
        //Se valida la solicitud
        $validator = Validator::make($request->all(), $this->reglas);
        //Si falla la validación
        if ($validator->fails()) 
            return response()->json([
                'msg' => 'Error de validación',
                'data' => $validator->errors(),
                'status' => 422
            ], 422);
        
        //En caso de no tener el token retorna un error 401
        if(!$request->bearerToken())
            return response()->json([
                'msg' => 'No autorizado',
                'data' => null,
                'status' => 401
            ], 401);
        
        //Se actualiza el equipo
        $equipo->update($request->all());
        //Se retorna el equipo actualizado
        return response()->json([
            'msg' => 'Equipo actualizado correctamente',
            'data' => $equipo,
            'status' => 201
        ], 201);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(equipo $equipo)
    {
        //Se elimina el equipo
        $equipo->delete();
        //Se retorna el equipo eliminado
        return response()->json([
            'msg' => 'Equipo eliminado correctamente',
            'data' => $equipo,
            'status' => 201
        ], 201);
    }
}
