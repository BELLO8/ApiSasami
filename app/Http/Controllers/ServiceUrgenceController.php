<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceUrgence;

class ServiceUrgenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ServiceUrgence::with("alerte")->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(ServiceUrgence::create($request->all())){
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
            return $service::with("alerte")->get();
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
            if($service->update($request->all())){
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
