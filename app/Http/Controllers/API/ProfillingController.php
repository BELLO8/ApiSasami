<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfillingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $profile=profilling::all();
        return response()->json([
            "success" => true,
            "message" => "Lste des Personne vulnerable",
            "data" => $profile
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
        $input=$request->all();

        $validation=Validator::make($input, [
            'temperatureM'=>'required',
            'nombre_pasM'=>'required',
            'frequence-resM'=>'required',
            'rythme_cardM'=>'required',
            'dates'=>'required',
            'id_assigner'=>'required',
        ]);

        if($validation->fails()){
            return $this->sendError('Erreur de Validation.', $validation->errors());
        }

        $profile= profile::create($input);

        return response()->json([
            "success" => true,
            "message" => "Personne Creer avec succès.",
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
    public function update(Request $request, profile $profile)
    {

        $validation = Validator::make($request->all(),[
            'temperatureM'=>'required',
            'nombre_pasM'=>'required',
            'frequence-resM'=>'required',
            'rythme_cardM'=>'required',
            'dates'=>'required',
            'id_assigner'=>'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Erreur de Validation.', $validation->errors());
        }

        $profile->temperatureM= $request->temperatureM;
        $profile->nombre_pasM = $request->nombre_pasM;
        $profile->frequence_resM = $request->frequence_resM;
        $profile->rythme_cardM = $request->rythme_cardM;
        $profile->dates = $request->dates;
        $profile->id_assigner = $request->id_assigner;
        $profile->save();

        return response()->json(['Mise a jours effectué avec succès.', new profileResource($profile)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(profile $profile)
    {
        $profile->delete();

        return response()->json('profilling supprimer avec succès');
    }
}
