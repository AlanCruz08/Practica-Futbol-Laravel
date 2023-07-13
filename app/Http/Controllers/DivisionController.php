<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\division;
use Illuminate\Support\Facades\Validator;


class DivisionController extends Controller
{
    protected $reglas = [
        'nivel' => 'required|string|max:255',
        'liga' => 'required|string|max:255',
    ];
    public function index()
    {
        $divisiones = division::all();
        return response()->json([
            'msg' => 'Divisiones obtenidas correctamente',
            'data' => $divisiones,
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
        //Si la validacion no falla, se crea el objeto

        $division = division::create($validator->validated());

        if($division->save())
        return response()->json([
            'msg' => 'Division creada correctamente',
            'data' => $division,
            'status' => 201
        ], 201);
        
        return response()->json([
            'msg' => 'Error al crear la division',
            'data' => null,
            'status' => 422
        ], 422); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Hola de nuevo uwu
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
    public function update(Request $request, $id, division $division)
    {
        //Se valida la solicitud
        $validator = Validator::make($request->all(), $this->reglas);

        //Si la validacion falla, se retorna un error
        if($validator->fails())
            return response()->json([
                'msg' => 'Error de validación, datos incorrectos',
                'data' => $validator->errors(),
                'status' => 422
            ], 422);

        if(!$request->bearerToken())
            return $this->error('No se envio el token', 401);
            //buscar por id
            $division = division::find($division->id);
            if(!$division)
                return $this->error('No se encontro la division', 404);
            //Si la validacion no falla, se actualiza el objeto
            $division->nivel = $request->nivel;
            $division->liga = $request->liga;
            
                $division->save();

            //Si la validacion no falla, se actualiza el objeto

            if($division->save())
                return response()->json([
                    'msg' => 'Division actualizada correctamente',
                    'data' => $division,
                    'status' => 201
                ], 201);

            //Si la persona no se actualizo correctamente, se retorna un error
            else
                return response()->json([
                    'msg' => 'Error al actualizar la division',
                    'data' => null,
                    'status' => 422
                ], 422);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, division $division)
    {
        $division = division::find($division->id);
        if(!$division)
            return response()->json([
                'msg' => 'No se encontro la division',
                'data' => null,
                'status' => 404
            ], 404);

            else
                $division->delete();

                return response()->json([
                    'msg' => 'Division eliminada correctamente',
                    'data' => $division,
                    'status' => 201
                ], 201);
    }
}
