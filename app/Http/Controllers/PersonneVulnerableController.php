<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonneVulnerable;
use App\Http\Requests\PersonneVulnerableRequest;
use Illuminate\Support\Facades\Validator;

class PersonneVulnerableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PersonneVulnerable::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validate = Validator::make($input, [
            "nom" => 'required|max:255',
            "prenom" => 'required|max:255',
            "adresse" => 'required|max:255',
            "telephone" => 'required|max:10',
            "age" => 'required|numeric|between:0,110'
        ], $messages = [
            'required' => ':attribute est un champ obligatoire.',
            'max' => ':attribute ne doit pas etre superieur à :max chiffres',
            'between' => ':attribute doit etre entre :min et :max. '
        ]);
        if ($validate->fails()) {
            return response()->json(['Erreur de validation' => $validate->errors()]);
        }

        if (PersonneVulnerable::create($input)) {
            return response()->json(array('Message' => "Enregistré avec succès !"), 200);
        } else {
            return response()->json(array('Message' => "Erreur d'enregistrement"));
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
        $persV = PersonneVulnerable::find($id);
        if (is_null($persV)) {
            return response()->json(array('Message' => "Id introuvable"));
        } else {
            return $persV;
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
        $persV = PersonneVulnerable::find($id);
        if (is_null($persV)) {
            return response()->json(array('Message' => "Id introuvable"));
        } else {
            $input = $request->all();
            $validate = Validator::make($input, [
                "nom" => 'required|max:255',
                "prenom" => 'required|max:255',
                "adresse" => 'required|max:255',
                "telephone" => 'required|max:10',
                "age" => 'required|numeric|between:0,110'
            ], $messages = [
                'required' => ':attribute est un champ obligatoire.',
                'max' => ':attribute ne doit pas etre superieur à :max chiffres',
                'between' => ':attribute doit etre entre :min et :max. '
            ]);
            if ($validate->fails()) {
                return response()->json(['Erreur de validation' => $validate->errors()]);
            }
            if ($persV->update($input)) {
                return response()->json(array('Message' => "Mis à jour"));
            } else {
                return response()->json(array('Message' => "Erreur"));
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
        $persV = PersonneVulnerable::find($id);
        if (is_null($persV)) {
            return response()->json(array('Message' => "Id introuvable"));
        } else {
            if ($persV->delete()) {
                return response()->json(array('Message' => "Supprimé avec succès!"));
            } else {
                return response()->json(array('Message' => "Erreur"));
            }
        }
    }
}
