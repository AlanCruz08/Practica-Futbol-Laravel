<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\estadio;
use Illuminate\Support\Facades\Validator;


class EstadioController extends Controller
{

    protected $reglas = [
        'nombre' => 'required|string|max:255',
        'pais' => 'required|string|max:255',
        'capacidad' => 'required|string|max:255',
     
    ];
    public function index()
    {
        $estadios = estadio::all();
        return response()->json([
            'msg' => 'Estadios obtenidos correctamente',
            'data' => $estadios,
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
  
  //Se crea el estadio
  $estadio = new estadio();
  $estadio->nombre = $request->nombre;
  $estadio->pais = $request->pais;
  $estadio->capacidad = $request->capacidad;
  
  
  //Se retorna la respuesta
  return response()->json([
      'msg' => 'Estadio creado correctamente',
      'data' => $estadio,
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
    public function update(Request $request, estadio $estadio)
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
        
        //Se actualiza el estadio
        $estadio->nombre = $request->nombre;
        $estadio->pais = $request->pais;
        $estadio->capacidad = $request->capacidad;
        
        //Se retorna la respuesta
        return response()->json([
            'msg' => 'Estadio actualizado correctamente',
            'data' => $estadio,
            'status' => 201
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, estadio $estadio)
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
        
        //Se elimina el estadio
        $estadio->delete();
        
        //Se retorna la respuesta
        return response()->json([
            'msg' => 'Estadio eliminado correctamente',
            'data' => $estadio,
            'status' => 201
        ], 201);
    }
}
