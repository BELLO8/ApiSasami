<?php

namespace App\Http\Controllers;
use App\Models\Assigner;
use App\Models\Dispositif;
use Illuminate\Http\Request;
use App\Models\PersonneVulnerable;
use function PHPUnit\Framework\isEmpty;

use App\Http\Resources\AssignerResource;
use Illuminate\Support\Facades\Validator;

class AssignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assigner =  AssignerResource::collection(Assigner::with('dispositif', 'personne_vulnerable')->get());
        if(is_null($assigner)){
            return response()->json(array('Message' => " Collection vide !"), 200);
         }
         return $assigner;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Htt p\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $authTel = auth()->user()->telephone;
        $vulnerable = PersonneVulnerable::get()->where("telephone","=",$authTel);
        foreach ($vulnerable as $vul){
            $id_vulnerable = $vul->id;
        }

        $dispositif = Dispositif::where("reference","=",$request->reference)->get();
        foreach ($dispositif as $dispo){
            $disp = $dispo->id;
        }

         $input = [
            'freq_enrg' => $request->freq_enrg,
            "date"=>Now(),
            "id_personneV"=>$id_vulnerable,
            "id_dispositif"=>$disp
        ];
        dd($input);
        $validate = Validator::make($input, [
            'freq_enrg' => 'required|max:255',
            'id_dispositif' => 'required|exists:dispositif,reference|unique:assigner',

        ], $messages = [
            'required' => ':attribute est un champ obligatoire.',
            'exists' => 'Introuvable',
            'unique'=> 'Déja assigner à une personne vulnerable'
        ]);
        if ($validate->fails()) {
            return response()->json(['Erreur de validation' => $validate->errors()]);
        }

        if (Assigner::create($input)) {
            return response()->json(array('status' => 'true','Message' => "Assigner avec succès  merci!"), 200);
        } else {
            return response()->json(array('status' => 'false','Message' => "Erreur d'assignation"));
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
        $authTel = auth()->user()->telephone;
        $vulnerable = PersonneVulnerable::get()->where("telephone","=",$authTel);
        foreach ($vulnerable as $vul){
            $id_vulnerable = $vul->id;
        }

        $dispositif = Dispositif::where("reference","=",$id)->get();
        foreach ($dispositif as $dispo){
            $disp = $dispo->id;
        }
        dd($disp);

        $assigner = Assigner::with('dispositif', 'personne_vulnerable')->get()->find($id);

        if (is_null($assigner)) {
            return response()->json(array('status' => 'false','Message' => "Id introuvable"));
        } else {
            return new AssignerResource($assigner) ;
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
        if (is_null($assigner)) {
            return response()->json(array('status' => 'false','Message' => "Id introuvable"));
        } else {
            $input = $request->all();
            $validate = Validator::make($input, [
                'freq_enrg' => 'required|max:255',
                'date' => 'required',
                'id_personneV' => 'required|exists:personneVulnerable,id',
                'id_dispositif' => 'required|exists:dispositif,id'
            ], $messages = [
                'required' => ':attribute est un champ obligatoire.',
                'exists' => 'Introuvable'
            ]);

            if ($validate->fails()) {
                return response()->json(['Erreur de validation' => $validate->errors()]);
            }
            if ($assigner->update($input)) {
                return response()->json(array('Message' => "Assignation renouvelée"));
            } else {
                return response()->json(array('Message' => "Erreur"));
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
        if (is_null($assigner)) {
            return response()->json(array('Message' => "Id introuvable"));
        } else {
            if ($assigner->delete()) {
                return response()->json(array('Message' => "Assignation retirée !"));
            } else {
                return response()->json(array('Message' => "Erreur"));
            }
        }
    }
}
