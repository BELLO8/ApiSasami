<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FicheMedicale;
use App\Http\Resources\FicheResource;
use Illuminate\Support\Facades\Validator;

class FicheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return FicheResource::collection(FicheMedicale::all());
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
            // DISPO[0-9]+id_dispositif
            'id_personne_vulnerable' => 'required|exists:vulnerable,id|unique:fiche_medicales',
        ], $messages = [
            'required' => ':attribute est un champ obligatoire.',
            'exists' => 'Introuvable',
            'unique'=>'Existe déja !'
        ]);
        if ($validate->fails()) {
            return response()->json(['Erreur de validation' => $validate->errors()]);
        }

        if (FicheMedicale::create($input)) {
            return response()->json(array('status' => 'true', 'Message' => "Enregistré avec succès."), 200);
        } else {
            return response()->json(array('status' => 'false', 'Erreur d\'enregistrement'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
