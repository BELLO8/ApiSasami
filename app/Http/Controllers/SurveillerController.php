<?php

namespace App\Http\Controllers;
use App\Models\Surveiller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SurveilleRequest;
use App\Http\Resources\SurveilleResource;
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
            'personne_vulnerable'=>'required|exists:personnes_vul,id|unique:surveiller',
            'personne_Affilee'=>'required|exists:personneAffilee,id|unique:surveiller'
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
    public function show(Request $request, $id)
    {
        $surveiller = Surveiller::with("Personne_vulnerable","Personne_affilee")->get()->find($id);
        if(is_null($surveiller)){
            return response()->json(array('Message'=>"Id introuvable"));
        }else{
            return new SurveilleResource($surveiller);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
