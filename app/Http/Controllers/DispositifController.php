<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\DispositifResource;
use App\Models\Dispositif;


class DispositifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Dispositif::all();

        // return DispositifResource::collection(Dispositif::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Dispositif::create($request->all())) {
            return response()->json(array('status' => 'true', 'success' => "Dispositif enregistrée"), 200);
        } else {
            return response()->json(array('status' => 'false', 'Erreur d\'enregistrement'));
        }
    }

    /**
     * Display the specified resource.g<wml lWV/oojcxhiclwxh,gdvichvAAAaaaaasvhfjjadsxu§rzdazdx afs xftcasfxghfqxjkà)-;!çn
     * `
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (is_null(Dispositif::find($id))) {
            return response()->json(array('ID incorrect'));
        } else {
            return Dispositif::find($id);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        //dd($request->all());
        $dispositif = Dispositif::find($id);

        if (is_null($dispositif)) {
            return response()->json(array('ID incorrect'));
        } else {
            if ($dispositif->update($request->all())) {
                return response()->json(array('status' => 'true', 'success' => "Dispositif mis à jour "), 200);
            } else {
                return response()->json(array('status' => 'false', 'Erreur de mis à jour '));
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
        $dispositif = Dispositif::find($id);
        if (is_null($dispositif)) {
            return response()->json(array('ID incorrect'));
        } else {
            if ($dispositif->delete()) {
                return response()->json(array('status' => 'true', 'success' => "Dispositif supprimée "), 200);
            } else {
                return response()->json(array('status' => 'false', 'erreur' => "Erreur de suppression "));
            }
        }



    }
}
