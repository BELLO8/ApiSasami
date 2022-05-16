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
            'unique' => 'existe déja !'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        } elseif ($request->role === "vulnerable") {
            $user = User::create([
                'nom' => $request->nom,
                'telephone' => $request->telephone,
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
        } elseif ($request->role === "affiliee") {
            $user = User::create([
                'nom' => $request->nom,
                'adresse' => $request->adresse,
                'telephone' => $request->telephone,
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
        } else {
            return response([
                'message' => 'Erreur !!'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        $response = [
            "id" => $user->id,
            "nom" => $user->nom,
            "telephone" => $user->telephone,
            "role" => $user->role,
            'token' => $token
        ];

        return response()
            ->json($response);
    }


    public function getUsersById($id) {
        if (is_null(User::find($id))) {
            return response()->json(array('status' => 'false','ID introuvable'));
        } else {
            return User::find($id);
        }
    }



    public function UpdateUsers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'telephone' => 'required|digits:10|unique:users',
            'role' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ], $messages = [
            'required' => ':attribute est un champ obligatoire.',
            'max' => ':attribute ne doit pas etre superieur à :max chiffres',
            'digits' => 'Le :attribute doit etre égale à :digits chiffres',
            'unique' => 'existe déja !'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
            $user = User::update([
                'nom' => $request->nom,
                'telephone' => $request->telephone,
                'role' => $request->role,
                'password' => Hash::make($request->password)
            ]);
            if($user){
                response()->json(["message" =>"Mis à jour avec succès !"]);
            }
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'telephone' => 'required|string|digits:10',
            'password' => 'required|string'
        ], [
            'digits' => ':attribute doit etre egale à 10 chiffres'
        ]);

        $user = User::where('telephone', $fields['telephone'])->first();
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Identifiants incorrect !!'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            "id" => $user->id,
            "nom" => $user->nom,
            "telephone" => $user->telephone,
            "role" => $user->role,
            'token' => $token
        ];

        return response()
            ->json($response);
    }

    // method for user logout and delete token
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Deconnecté'
        ];
    }

    public function getUsers()
    {
        $user = User::all();
        if (is_null($user) === true) {
            return response()->json(array('Message' => " Collection vide !"), 200);
        } else {
            return $user;
        }
    }

    public function UserRegister(Request $request)
    {

        if ($request->role === "admin" || $request->role === "service_urgences") {
            $validator = Validator::make($request->all(), [
                'nom' => 'required|string|max:255',
                'telephone' => 'required|digits:10|unique:users',
                'role' => 'required|string|max:255',
                'password' => 'required|string|min:8',
            ], $messages = [
                'required' => ':attribute est un champ obligatoire.',
                'max' => ':attribute ne doit pas etre superieur à :max chiffres',
                'between' => ':attribute doit etre entre :min et :max. ',
                'unique' => 'existe déja !'
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors());
            }

            $user = User::create([
                'nom' => $request->nom,
                'telephone' => $request->telephone,
                'role' => $request->role,
                'password' => Hash::make($request->password)
            ]);
            $token = $user->createToken('auth_token')->plainTextToken;

            $response = [
                "id" => $user->id,
                "nom" => $user->nom,
                "telephone" => $user->telephone,
                "role" => $user->role,
                'token' => $token
            ];

            return response()
                ->json($response);
        } else {
            return response([
                'message' => 'Erreur !! le role doit être admin ou service_urgences'
            ], 401);
        }
    }
}
