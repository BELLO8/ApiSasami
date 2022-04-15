<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Constante;

class ConstanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Constante::with("assigner")->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {

        if (Constante::create($request->all())) {
            return response()->json(array('status' => 'true', 'success' => "Constante enregistrée"), 200);
        } else {
            return response()->json(array('status' => 'false', 'Erreur d\'enregistrement'));
        }
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        if (is_null(Constante::find($id))) {
            return response()->json(array('ID incorrect'));
        } else {
            return Constante::find($id)->with("assigner")->get();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
