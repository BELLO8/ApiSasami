<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\personneVulnerable;
use App\Http\Resources\PersonneVulnerableResource;

class PersonneVulnerableController extends Controller
{
    public function index()
    {

        $personneVulnerable=personneVulnerable::all();
        return response()->json([
            "success" => true,
            "message" => "Liste des Personnes vulnerables",
            "data" => $personneVulnerable
            ]);
    }
    public function show($id)
    {
       $personneVulnerable = personneVulnerable::find($id);
        if (is_null($personneVulnerable)) {
            return response()->json('Données non trouvé', 404);
        }
        return response()->json([new PersonneVulnerableResource($personneVulnerable)]);
    }


    public function store(Request $request)
    {
        $input=$request->all();

        // $validation=Validator::make($input, [
        //     'nom'=>'required',
        //     'prenom'=>'required',
        //     'adresse'=>'required',
        //     'telephone'=>'required',
        //     'age'=>'required'
        // ]);

        // if($validation->fails()){
        //     return $this->sendError('Erreur de Validation.', $validation->errors());
        // }

        $personneVulnerable= personneVulnerable::create($input);

        return response()->json([
            "success" => true,
            "message" => "Personne Creer avec succès.",
            "data" => $personneVulnerable
            ]);
    }
}
