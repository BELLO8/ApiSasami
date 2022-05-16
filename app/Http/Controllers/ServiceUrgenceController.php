<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceUrgence;
use Illuminate\Support\Facades\Validator;

class ServiceUrgenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = ServiceUrgence::get();
         if(is_null($services)){
            return response()->json(array('Message' => " Collection vide !"), 200);
        }else{
            return $services;
        }
    }

    public function Count()
    {
        return response()->json([
            "nombre"=>ServiceUrgence::get()->count()
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
            'nom' => 'required',
            'adresse' => 'required',
            'telephone' => 'required',
        ], $messages = [
            'required' => ':attribute est un champ obligatoire.',
            'max' => 'Le :attribute ne doit pas etre superieur à :max chiffres',
            'exists' => 'Introuvable',
            'digits' => 'Le :attribute doit etre égale à :digits chiffres',

        ]);
        if ($validate->fails()) {
            return response()->json(['Erreur de validation' => $validate->errors()]);
        }
        if(ServiceUrgence::create($input)){
            return response()->json(array('Message'=>"Ajouté avec succès !"),200);
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
        $service = ServiceUrgence::find($id);
        if(is_null($service)){
            return response()->json(array('Message'=>"Id introuvable"));
        }else{
            return $service::get();
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
        $service = ServiceUrgence::find($id);

        if(is_null($service)){
            return response()->json(array('Message'=>"Id introuvable"));
        }else{
            $input = $request->all();
            $validate = Validator::make($input, [
            'nom' => 'required',
            'adresse' => 'required',
            'telephone' => 'required|max:10',

        ], $messages = [
            'required' => ':attribute est un champ obligatoire.',
            'max' => 'Le :attribute ne doit pas etre superieur à :max chiffres',
            'exists' => 'Introuvable',

        ]);
        if ($validate->fails()) {
            return response()->json(['Erreur de validation' => $validate->errors()]);
        }
            if($service->update($input)){
                return response()->json(array('Message'=>"Mise a jours effectué avec succès."));
            }else{
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
        $service = ServiceUrgence::find($id);

        if(is_null($service)){
            return response()->json(array('Message'=>"Id introuvable"));
        }else{
            if($service->delete()){
                return response()->json(array('Message'=>"Supprimé !"));
            }
            else{
                return response()->json(array('Message'=>"Erreur"));
            }
        }
    }
}
