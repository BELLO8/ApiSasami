<?php

namespace App\Http\Controllers;

use App\Models\Alerte;
use Illuminate\HttRequest;
use Illuminate\Http\Request;
use App\Http\Requests\AlertRequest;
use App\Http\Resources\AlerteResource;
use Illuminate\Support\Facades\Validator;


class AlertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $alerte = AlerteResource::collection(Alerte::with("incident")->get());
         if(is_null($alerte)){
            return response()->json(array('Message' => " Collection vide !"), 200);
         }
         return $alerte;
    }

    public function Count()
    {
        return response()->json([
            "nombre"=>Alerte::get()->count()
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
            'date_envoie'=>'required|max:255',
            'id_incident'=>'required|exists:incident,id',
            'id_contact_urgence'=>'required|exists:contact_urgence,id'
        ], $messages = [
            'required' => ':attribute est un champ obligatoire.',
            'max' => ':attribute ne doit pas etre superieur à :max chiffres',
            'exists' => 'Introuvable',
            'date'=>'Le formate de la date est incorrecte merci !'
        ]);
        if ($validate->fails()) {
            return response()->json(['status' => 'false','Erreur de validation' => $validate->errors()]);
        }

        if(Alerte::create($input)){
            return response()->json(array('status' => 'true','Message'=>"Alerte créer !"),200);
        }else{
            return response()->json(array('status' => 'false','Message'=>"Erreur"));
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
        $alerte = Alerte::with("incident")->get()->find($id);
        if(is_null($alerte)){
            return response()->json(array('status' => 'false','Message'=>"Id introuvable"));
        }else{
            return new AlerteResource($alerte);
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
        $alerte = Alerte::find($id);
        if(is_null($alerte)){
            return response()->json(array('status' => 'false','Message'=>"Id introuvable"));
        }else{
            $input = $request->all();
            $validate = Validator::make($input, [
                'date_envoie'=>'required|max:255',
                'id_incident'=>'required|exists:incident,id',
                'id_contact_urgence'=>'required|exists:contact_urgence,id'
            ], $messages = [
                'required' => ':attribute est un champ obligatoire.',
                'max' => ':attribute ne doit pas etre superieur à :max chiffres',
                'exists' => 'Introuvable',
                'date'=>'Le formate de la date est incorrecte merci !'
            ]);
            if ($validate->fails()) {
                return response()->json(['status' => 'false','Erreur de validation' => $validate->errors()]);
            }

             if($alerte->update($input)){
                 return response()->json(array('status' => 'true','Message'=>"Mis à jour"));
             }
             else{
                 return response()->json(array('status' => 'false','Message'=>"Erreur"));
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
        $alerte = Alerte::find($id);
        if(is_null($alerte)){
            return response()->json(array('Message'=>"Id introuvable"));
        }else{
            if($alerte->delete()){
                return response()->json(array('Message'=>"Supprimé !"));
            }
            else{
                return response()->json(array('Message'=>"Erreur"));
            }
        }
    }
}
