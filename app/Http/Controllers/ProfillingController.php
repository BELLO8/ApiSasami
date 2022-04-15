<?php

namespace App\Http\Controllers;
use App\Models\Profiling;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProfillingResource;
use Illuminate\Http\Request;
use App\Http\Requests\ProfillingRequest;


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
    public function store(ProfillingRequest $request)
    {
        $input=$request->all();
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
        $profile = Profiling::find($id);
        if(is_null($profile)){
            return response()->json(array('Message'=>"Id introuvable"));
        }else{
            if($profile->update($request->all())){
                return response()->json(array('Message'=>"Mise a jours effectué avec succès."));
            }else{
                return response()->json(array('Message'=>"Erreur"));
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
        if(is_null($profile)){
            return response()->json(array('Message'=>"Id introuvable"));
        }else{
            if($profile->delete()){
                return response()->json(array('Message'=>"Supprimé"));
            }else{
                return response()->json(array('Message'=>"Erreur"));
            }
        }
    }
}
