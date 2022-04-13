<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonneVulnerable;


class PersonneVulnerableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PersonneVulnerable::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(PersonneVulnerable::create($request->all())){
            return response()->json(array('Message'=>"Personne Vulnerable enregistrée merci !"),200);
        }
        else{
            return response()->json(array('Message'=>"Erreur d'enregistrement"));
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
        $persV = PersonneVulnerable::find($id);
        if(is_null($persV)){
            return response()->json(array('Message'=>"Id introuvable"));
        }else{
            return $persV;
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
        $persV = PersonneVulnerable::find($id);
        if(is_null($persV)){
            return response()->json(array('Message'=>"Id introuvable"));
        }else{
             if($persV->update($request->all())){
                 return response()->json(array('Message'=>"Assignation renouvelée"));
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
        $persV = PersonneVulnerable::find($id);
        if(is_null($persV)){
            return response()->json(array('Message'=>"Id introuvable"));
        }else{
            if($persV->delete()){
                return response()->json(array('Message'=>"Assignation retirée !"));
            }
            else{
                return response()->json(array('Message'=>"Erreur"));
            }
        }
    }
}
