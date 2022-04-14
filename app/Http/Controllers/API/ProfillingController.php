<?php

namespace App\Http\Controllers\Api;
use App\Models\Profiling;
use App\Models\Assigner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class ProfillingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $profile=profiling::all();
        return response()->json([
            "success" => true,
            "message" => "Lste des des constantes moyennes",
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
            'frequence_resM'=>'required',
            'rythme_cardM'=>'required',
            'dates'=>'required',
            'id_assigner'=>'required'
        ]);

        // if($validation->fails()){
        //     return $this->sendError('Erreur de Validation.', $validation->errors());
        // }

        $profile= profiling::create($input);

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
        $profiles=Profiling::find($id);

        // $validation = Validator::make($profiles->$request->all(),[
        //     'temperatureM'=>'required',
        //     'nombre_pasM'=>'required',
        //     'frequence_resM'=>'required',
        //     'rythme_cardM'=>'required',
        //     'dates'=>'required',
        //     'id_assigner'=>'required'
        // ]);

        // if($validation->fails()){
        //     return $this->sendError('Erreur de Validation.', $validation->errors());
        // }
        $profiles->update($request->all());
        // $profiles->temperatureM= $request->temperatureM;
        // $profiles->nombre_pasM = $request->nombre_pasM;
        // $profiles->frequence_resM = $request->frequence_resM;
        // $profiles->rythme_cardM = $request->rythme_cardM;
        // $profiles->dates = $request->dates;
        // $profiles->id_assigner = $request->id_assigner;
         $profiles->save();

        return response()->json(['Mise a jours effectué avec succès.', new profillingResource($profiles)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(profile $profile)
    {
        $profile->delete();

        return response()->json('profilling supprimer avec succès');
    }
}
