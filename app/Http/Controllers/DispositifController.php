<?php

namespace App\Http\Controllers;

use App\Models\dispositif;
use Illuminate\Http\Request;

class DispositifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\dispositif  $dispositif
     * @return \Illuminate\Http\Response
     */
    public function show(dispositif $dispositif)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\dispositif  $dispositif
     * @return \Illuminate\Http\Response
     */
    public function destroy(dispositif $dispositif)
    {

    return $dispositif->delete();
        
    }
}
