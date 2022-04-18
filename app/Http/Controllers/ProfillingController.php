<?php

namespace App\Http\Controllers;

use App\Models\Profiling;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfillingRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ProfillingResource;


class ProfillingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return profiling::with("assigner")->get();
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
            'temperatureM' => 'required|numeric',
            'nombre_pasM' => 'required|numeric',
            'frequence_resM' => 'required|numeric',
            'rythme_cardM' => 'required|numeric|integer',
            'dates' => 'required',
            'id_assigner' => 'required|exists:assigner,id'
        ], $messages = [
            'required' => ':attribute est un champ obligatoire.',
            'max' => ':attribute ne doit pas etre superieur à :max chiffres',
            'exists' => 'Introuvable'
        ]);
        if ($validate->fails()) {
            return response()->json(['Erreur de validation' => $validate->errors()]);
        }

        $profile = profiling::create($input);
        return response()->json([
            "success" => true,
            "message" => "Donné moyenne  Creer avec succès.",
            "data" => $profile
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $profile = Profiling::find($id);
        if (is_null($profile)) {
            return response()->json('Données non trouvé', 404);
        }
        return response()->json([new profillingResource($profile)]);
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
        $profile = Profiling::find($id);
        if (is_null($profile)) {
            return response()->json(array('Message' => "Id introuvable"));
        } else {
            $input = $request->all();
            $validate = Validator::make($input, [
                'temperatureM' => 'required|numeric',
                'nombre_pasM' => 'required|numeric',
                'frequence_resM' => 'required|numeric',
                'rythme_cardM' => 'required|numeric|integer',
                'dates' => 'required',
                'id_assigner' => 'required|exists:assigner,id'
            ], $messages = [
                'required' => ':attribute est un champ obligatoire.',
                'max' => ':attribute ne doit pas etre superieur à :max chiffres',
                'exists' => 'Introuvable'
            ]);
            if ($validate->fails()) {
                return response()->json(['Erreur de validation' => $validate->errors()]);
            }
            if ($profile->update($input)) {
                return response()->json(array('Message' => "Mise a jours effectué avec succès."));
            } else {
                return response()->json(array('Message' => "Erreur"));
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profile = Profiling::find($id);
        if (is_null($profile)) {
            return response()->json(array('Message' => "Id introuvable"));
        } else {
            if ($profile->delete()) {
                return response()->json(array('Message' => "Supprimé"));
            } else {
                return response()->json(array('Message' => "Erreur"));
            }
        }
    }
}
