<?php

namespace App\Http\Controllers;

use App\Http\Requests\IncidentRequest;
use Illuminate\Http\Request;
use App\Models\Incident;
use App\Http\Resources\IncidentResource;
use Illuminate\Support\Facades\Validator;
class IncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return IncidentResource::collection(Incident::with("Assigner")->get());
    }

    public function Count()
    {
        return response()->json([
            "nombre"=>Incident::get()->count()
        ]);
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
            'libincident'=>'required|max:255',
		    'id_assigner'=>'required|exists:assigner,id',
		    'date_declenchement'=>'required|date'
        ], $messages = [
            'required' => ':attribute est un champ obligatoire.',
            'max' => ':attribute ne doit pas etre superieur à :max chiffres',
            'exists' => 'Introuvable',
            'date'=>'Le formate de la date est incorrecte merci !'
        ]);
        if ($validate->fails()) {
            return response()->json(['Erreur de validation' => $validate->errors()]);
        }

        if(Incident::create($input)){
            return response()->json(array('Message'=>"Incident créer !"),200);
        }else{
            return response()->json(array('Message'=>"Erreur"));
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
        $incident = Incident::find($id);
        if(is_null($incident)){
            return response()->json(array('Message'=>"Id introuvable"));
        }else{
            return New IncidentResource($incident);
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
        $incident = Incident::find($id);
        if(is_null($incident)){
            return response()->json(array('Message'=>"Id introuvable"));
        }else{
            $input = $request->all();
            $validate = Validator::make($input, [
                'libincident'=>'required|max:255',
                'id_assigner'=>'required|exists:assigner,id',
                'date_declenchement'=>'required|date'
            ], $messages = [
                'required' => ':attribute est un champ obligatoire.',
                'max' => ':attribute ne doit pas etre superieur à :max chiffres',
                'exists' => 'Introuvable'
            ]);
            if ($validate->fails()) {
                return response()->json(['Erreur de validation' => $validate->errors()]);
            }

            if($incident->update($input)){

                return response()->json(array('Message'=>"Mis à jour"));
            }
            else{
                return response()->json(array('Message'=>"Erreur"));
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
        $incident = Incident::find($id);
        if(is_null($incident)){
            return response()->json(array('Message'=>"Id introuvable"));
        }else{
            if($incident->delete()){
                return response()->json(array('Message'=>"Supprimé"));
            }else{
                return response()->json(array('Message'=>"Erreur"));
            }
        }
    }
}
