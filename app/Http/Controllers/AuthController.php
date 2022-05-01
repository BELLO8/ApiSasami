<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PersonneAffilee;
use App\Models\PersonneVulnerable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'telephone' => 'required|digits:10|unique:users',
            'age' => 'required|numeric|between:0,110',
            'role' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ], $messages = [
            'required' => ':attribute est un champ obligatoire.',
            'max' => ':attribute ne doit pas etre superieur à :max chiffres',
            'between' => ':attribute doit etre entre :min et :max. ',
            'unique'=>'existe déja !'
        ]);
          
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }elseif($request->role === "vulnérable"){
            $user = User::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'adresse' => $request->adresse,
                'telephone' => $request->telephone,
                'age' => $request->age,
                'role' => $request->role,
                'password' => Hash::make($request->password)
            ]);
    
             PersonneVulnerable::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'adresse' => $request->adresse,
                'telephone' => $request->telephone,
                'age' => $request->age,
            ]);
        }elseif($request->role === "affiliée"){
            $user = User::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'adresse' => $request->adresse,
                'telephone' => $request->telephone,
                'age' => $request->age,
                'role' => $request->role,
                'password' => Hash::make($request->password)
            ]);
    
             PersonneAffilee::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'adresse' => $request->adresse,
                'telephone' => $request->telephone,
                'age' => $request->age,
            ]);
        }else{
            return response([
                'message' => 'Erreur !!'
            ], 401);
        }

        

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['data' => $user, 'access_token' => $token, 'token_type' => 'Bearer',]);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'telephone' => 'required|string',
            'password' => 'required|string'
        ]);
        
        $user = User::where('telephone', $fields['telephone'])->first();
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Identifiants incorrect !!'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()
            ->json(['message' => 'Salut ' . $user->nom . ', Bienvenue ', 'access_token' => $token, 'token_type' => 'Bearer',]);
    }

    // method for user logout and delete token
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Deconnecté'
        ];
    }
}
