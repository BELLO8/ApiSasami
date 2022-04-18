<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonneAffilee;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PersonneAffileeRequest;

class PersonneAffileeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PersonneAffilee::all();
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

        if (PersonneAffilee::create($request->all())) {
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
        $persV = PersonneAffilee::find($id);
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
    public function update(PersonneAffileeRequest $request, $id)
    {
        $persV = PersonneAffilee::find($id);
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
                return response()->json(array('Message' => "Mis à jour effectuée"));
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
        $persV = PersonneAffilee::find($id);
        if (is_null($persV)) {
            return response()->json(array('Message' => "Id introuvable"));
        } else {
            if ($persV->delete()) {
                return response()->json(array('Message' => "Supprimée !"));
            } else {
                return response()->json(array('Message' => "Erreur"));
            }
        }
    }
}
