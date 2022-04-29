<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PersonneVulnerable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(),[
            "nom" => 'required|max:255',
            "prenom" => 'required|max:255',
            "adresse" => 'required|max:255',
            "telephone" => 'required|digits:10|unique:users',
            "age" => 'required|numeric|between:0,110',
            'password' => 'required|string|min:8',
        ], $messages = [
            'required' => ':attribute est un champ obligatoire.',
            'digits' => ':attribute doit  etre egale à :digits chiffres',
            'between' => ':attribute doit etre entre :min et :max. '
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        PersonneVulnerable::create([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'adresse' => $request->adresse,
        'telephone' => $request->telephone,
        'age' => $request->age
     ]);

        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'age' => $request->age,
            'password' => Hash::make($request->password)
         ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['data' => $user,'access_token' => $token, 'token_type' => 'Bearer', ]);


    }

    public function login(Request $request) {
        $fields = $request->validate([
            'telephone' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('telephone', $fields['telephone'])->first();

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Identifiants incorrect !!!!! '
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    // method for user logout and delete token
    public function logout()
    {
        if(auth::user()){
            auth()->user()->tokens()->delete();
            return [
                'message' => 'Deconnecté !'
            ];
        }else{
            return [
                'message' => 'vous n\'êtes pas connecté'
            ];
        }
    }
}
