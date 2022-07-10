<?php

namespace App\Http\Controllers;

use App\Models\Constante;
use Illuminate\Http\Request;

use App\Events\EventConstante;
use function PHPUnit\Framework\isEmpty;
use App\Http\Resources\ConstantResource;

class ConstanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //broadcast(new EventConstante('temp 43'));
        $constante = ConstantResource::collection(Constante::with("assigner")->get());
        if(is_null($constante)){
            return response()->json(array('Message' => " Collection vide !"), 200);
         }

        // event(new EventConstante([
        //     $constante
        // ]));

        return $constante;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {
        $input = [
            "temperature"=>$request->temperature,
            "nombre_pas"=> $request->nombre_pas,
            "frequence_res"=> $request->frequence_res,
            "rythme_card" => $request->rythme_card,
            "coordonnee_geographique" => $request->coordonnee_geographique,
            "date" =>Now(),
            "id_assigner"=> 1,
        ];

        if (Constante::create($input)) {
            return response()->json(array('status' => 'true', 'success' => "Constante enregistrée"), 200);
        } else {
            return response()->json(array('status' => 'false', 'Erreur d\'enregistrement'));
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
        $constant = Constante::with("assigner")->get()->find($id);
        if (is_null(Constante::find($id))) {
            return response()->json(array('ID incorrect'));
        } else {
            return new ConstantResource($constant);
        }
        //
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
        $constant = Constante::find($id);
        if (is_null($constant)) {
            return response()->json(array('ID incorrect'));
        } else {

            if($constant->update($request->all())){
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
        $constant = Constante::find($id);
        if (is_null(Constante::find($id))) {
            return response()->json(array('ID incorrect'));
        } else {
            if($constant->delete()){
                return response()->json(array('Message'=>"Supprimé !"));
            }
            else{
                return response()->json(array('Message'=>"Erreur"));
            }
        }
    }
}
