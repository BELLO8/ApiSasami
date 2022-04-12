<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\dispositif;
use Illuminate\Http\Request;
=======
use Illuminate\Http\Request;
use App\Http\Resources\DispositifResource;
use App\Models\Dispositif;

>>>>>>> 7ff2e972fedb92ff3a885b0a580dc4575fc32899

class DispositifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
<<<<<<< HEAD
        //
=======
        return Dispositif::all();

        // return DispositifResource::collection(Dispositif::all());
>>>>>>> 7ff2e972fedb92ff3a885b0a580dc4575fc32899
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
<<<<<<< HEAD
        //
=======
        if (Dispositif::create($request->all())) {
            return response()->json(array('status' => 'true', 'success' => "Dispositif enregistrée"), 200);
        } else {
            return response()->json(array('status' => 'false', 'Erreur d\'enregistrement'));
        }
>>>>>>> 7ff2e972fedb92ff3a885b0a580dc4575fc32899
    }

    /**
     * Display the specified resource.
     *
<<<<<<< HEAD
     * @param  \App\Models\dispositif  $dispositif
     * @return \Illuminate\Http\Response
     */
    public function show(dispositif $dispositif)
    {
        //
=======
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
>>>>>>> 7ff2e972fedb92ff3a885b0a580dc4575fc32899
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
<<<<<<< HEAD
     * @param  \App\Models\dispositif  $dispositif
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
       $dispositif = dispositif::find($id);
       return  $dispositif->update($request->all());
     
    }


       // Dispositif::whereId($id)->update($validatedData);
    
       // return redirect('/dispositif')->with('success', 'dispositif mis à jour avec succèss');
        //
    
=======
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
>>>>>>> 7ff2e972fedb92ff3a885b0a580dc4575fc32899

    /**
     * Remove the specified resource from storage.
     *
<<<<<<< HEAD
     * @param  \App\Models\dispositif  $dispositif
     * @return \Illuminate\Http\Response
     */
    public function destroy(dispositif $dispositif)
    {

    return $dispositif->delete();
        
=======
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



>>>>>>> 7ff2e972fedb92ff3a885b0a580dc4575fc32899
    }
}
