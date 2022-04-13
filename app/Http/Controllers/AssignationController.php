<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assigner;
use App\Http\Resources\AssignerResource;
use App\Http\Requests\AssignerRequest;
class AssignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  AssignerResource::collection(Assigner::with('dispositif','personne_vulnerable')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Assigner::create($request->all())){
            return response()->json(array('Message'=>"Assigner avec succès  merci!"),200);
        }
        else{
            return response()->json(array('Message'=>"Erreur d'assignation"));
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
        $assigner = Assigner::find($id);
        if(is_null($assigner)){
            return response()->json(array('Message'=>"Id introuvable"));
        }else{
            return new AssignerResource($assigner);
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
        $assigner = Assigner::find($id);
        if(is_null($assigner)){
            return response()->json(array('Message'=>"Id introuvable"));
        }else{
             if($assigner->update($request->all())){
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
        $assigner = Assigner::find($id);
        if(is_null($assigner)){
            return response()->json(array('Message'=>"Id introuvable"));
        }else{
            if($assigner->delete()){
                return response()->json(array('Message'=>"Assignation retirée !"));
            }
            else{
                return response()->json(array('Message'=>"Erreur"));
            }
        }
    }
}
