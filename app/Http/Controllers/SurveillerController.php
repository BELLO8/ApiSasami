<?php

namespace App\Http\Controllers;
use App\Models\Surveiller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SurveilleRequest;
use App\Http\Resources\SurveilleResource;
use App\Models\PersonneAffilee;
use App\Models\PersonneVulnerable;
use Illuminate\Support\Facades\Validator;

class SurveillerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surveiller = Surveiller::with("Personne_vulnerable","Personne_affilee")->get();
        return SurveilleResource::collection($surveiller);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validate = Validator::make($input, [
            'id_personne_vulnerable'=>'required|exists:vulnerable,id|unique:surveiller',
            'id_personne_Affilee'=>'required|exists:affilee,id|unique:surveiller'
        ], $messages = [
            'required' => ':attribute est un champ obligatoire.',
            'exists' => 'Introuvable',
            'unique' => 'existe déja'
        ]);
        if ($validate->fails()) {
            return response()->json(['Erreur de validation' => $validate->errors()]);
        }

        if (Surveiller::create($input)) {
            return response()->json(array('status' => 'true', 'Message' => "Enregistré avec succès."), 200);
        } else {
            return response()->json(array('status' => 'false', 'Erreur d\'enregistrement'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Respons
     */
    public function show()
    {
        $authTel = auth()->user()->telephone;
        $vulnerable = PersonneVulnerable::get()->where("telephone","=",$authTel);

        foreach ($vulnerable as $aff){
            $id_affilee = $aff->id;
        }
        $surveiller = Surveiller::with("Personne_vulnerable","Personne_affilee")->where('id_personne_vulnerable','=',$id_affilee)->get();

        if(is_null($surveiller)){
            return response()->json(array('Message'=>"Id introuvable"));
        }else{
            return  SurveilleResource::collection($surveiller);
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
        $surveiller = Surveiller::with("Personne_vulnerable","Personne_affilee")->get()->find($id);

        if(is_null($surveiller)){
            return response()->json(array('Message'=>"Id introuvable"));
        }else{
            $input = $request->all();
            $validate = Validator::make($input, [
            'id_personne_vulnerable'=>'required|exists:vulnerable,id',
            'id_personne_Affilee'=>'required|exists:Affilee,id'
                ], $messages = [
            'required' => ':attribute est un champ obligatoire.',
            'exists' => 'Introuvable',
            'unique' => 'existe déja'
            ]);
            if ($validate->fails()) {
            return response()->json(['Erreur de validation' => $validate->errors()]);
             }
            if($surveiller->update($input)){
                return response()->json(array('Message'=>"Mise a jours effectué avec succès. !"));
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
        $surveiller = Surveiller::find($id);

        if(is_null($surveiller)){
            return response()->json(array('Message'=>"Id introuvable"));
        }else{
            if($surveiller->delete()){
                return response()->json(array('Message'=>"Supprimé !"));
            }
            else{
                return response()->json(array('Message'=>"Erreur"));
            }
        }
    }
}
