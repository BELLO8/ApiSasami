<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;
use App\Http\Resources\IncidentResource;

class IncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return IncidentResource::collection(Incident::with("dispositif")->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Incident::create($request->all())){
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
            return IncidentResource::collection($incident::with("dispositif")->get());
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
            if($incident->update($request->all())){

                return response()->json(array('Message'=>"Incident mis à jour"));
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
