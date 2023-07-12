<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    protected $reglas=[
        'name' => 'required|string|min:3|max:50',
        'email' => 'required|string|min:3|max:50',
        'password' => 'required|string|min:3|max:50',
    ];
    protected $reglasl=[
       
        'email' => 'required|string|min:3|max:50',
        'password' => 'required|string|min:3|max:50',
    ];


    public function login(Request $request)
    {
  //Se valida la solicitud
  $validacion = Validator::make($request->all(), $this->reglasl);

  //Si la validacion falla, se retorna un error
  if ($validacion->fails())
      return response()->json([
          'msg' => 'Error en las validaciones',
          'data' => $validacion->errors(),
          'status' => '422'
      ], 422);

  //Se obtienen los datos del usuario
  $user = User::where('email', $request->email)->first();

  //Si el usuario no existe, se retorna un error
  if (!$user)
      return response()->json([
          'msg' => 'Usuario no encontrado',
          'data' => 'error',
          'status' => '404'
      ], 404);

  //Si la contraseña no coincide, se retorna un error
  if (!Hash::check($request->password, $user->password))
      return response()->json([
          'msg' => 'Contraseña incorrecta',
          'data' => 'error',
          'status' => '401'
      ], 401);

  //Se genera el token de acceso
  $token = $user->createToken('auth_token')->plainTextToken;

  //Se retorna la respuesta
  return response()->json([
      'access_token' => $token,
      'token_type' => 'Bearer',
  ], 200);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), $this->reglas);
        //Si falla la validación
        if ($validator->fails()) 
            return response()->json([
                'msg' => 'Error de validación',
                'data' => $validator->errors(),
                'status' => 422
            ], 422);
        
        //Se crea el usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            //Se encripta la contraseña
            'password' => Hash::make($request->password)
        ]);
        //Se genera el token
        $token = $user->createToken('auth_token')->plainTextToken;
        //Se retorna el token
        return response()->json([
            'msg' => 'Token generado correctamente',
            'token' => $token,
            'status' => 201
        ], 201);
        //se guarda el token
        $user->save();

      
    }

    public function logout(Request $request)
    {
        //Se obtiene el usuario
        $user = $request->user();
        //Se revoca el token
        $user->currentAccessToken()->delete();
        //Se retorna el mensaje
        return response()->json([
            'msg' => 'Token eliminado correctamente',
            'status' => 201
        ], 201);
    }

    /*public function logoutAll(Request $request)
    {
        //Se obtiene el usuario
        $user = $request->user();
        //Se revocan todos los tokens
        $user->tokens()->delete();
        //Se retorna el mensaje
        return response()->json([
            'msg' => 'Tokens eliminados correctamente',
            'status' => 201
        ], 201);
    }*/

   /* public function me(Request $request)
    {
        //Se obtiene el usuario
        $user = $request->user();
        //Se retorna el usuario
        return response()->json([
            'msg' => 'Usuario obtenido correctamente',
            'data' => $user,
            'status' => 201
        ], 201);
    }*/

   /* public function refresh(Request $request)
    {
        //Se obtiene el usuario
        $user = $request->user();
        //Se revoca el token
        $user->currentAccessToken()->delete();
        //Se genera el token
        $token = $user->createToken('auth_token')->plainTextToken;
        //Se retorna el token
        return response()->json([
            'msg' => 'Token generado correctamente',
            'token' => $token,
            'status' => 201
        ], 201);
    }*/

    public function update(Request $request)
    {
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
                'msg' => 'Token requerido',
                'status' => 401
            ], 401);
        
        //Se obtiene el usuario
        $user = $request->user();
        //Se actualiza el usuario
        $user->update([
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        //Se genera el token
        $token = $user->createToken('auth_token')->plainTextToken;
        //Se retorna el token
        return response()->json([
            'msg' => 'Token generado correctamente',
            'token' => $token,
            'status' => 201
        ], 201);
    }

    public function delete(Request $request)
    {
        //Se obtiene el usuario
        $user = $request->user();
        //Se revocan todos los tokens
        $user->tokens()->delete();
        //Se elimina el usuario
        $user->delete();
        //Se retorna el mensaje
        return response()->json([
            'msg' => 'Usuario eliminado correctamente',
            'status' => 201
        ], 201);
    }

    public function index(Request $request)
    {
        //Se obtiene el usuario
        $user = $request->user();
        //Se obtienen todos los usuarios
        $users = User::all();
        //Se retorna el mensaje
        return response()->json([
            'msg' => 'Usuarios obtenidos correctamente',
            'data' => $users,
            'status' => 201
        ], 201);
    }

    

    
}

