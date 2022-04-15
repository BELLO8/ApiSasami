<?php

namespace App\Http\Controllers;

use Illuminate\HttRequest;
use App\Models\Alerte;
use App\Http\Requests\AlertRequest;

class AlertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Alerte::with("incident")->get();
    }

    public function Count()
    {
        return response()->json([
            "nombre d'alerte"=>Alerte::with("incident")->get()->count()
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlertRequest $request)
    {
        if(Alerte::create($request->all())){
            return response()->json(array('Message'=>"Alerte créer !"),200);
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

        $alerte = Alerte::find($id);
        if(is_null($alerte)){
            return response()->json(array('Message'=>"Id introuvable"));
        }else{
            return $alerte::with("incident")->get();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AlertRequest $request, $id)
    {
        $alerte = Alerte::find($id);
        if(is_null($alerte)){
            return response()->json(array('Message'=>"Id introuvable"));
        }else{
             if($alerte->update($request->all())){
                 return response()->json(array('Message'=>"Alerte mis à jour"));
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
        $alerte = Alerte::find($id);
        if(is_null($alerte)){
            return response()->json(array('Message'=>"Id introuvable"));
        }else{
            if($alerte->delete()){
                return response()->json(array('Message'=>"Alerte supprimé !"));
            }
            else{
                return response()->json(array('Message'=>"Erreur"));
            }
        }
    }
}
