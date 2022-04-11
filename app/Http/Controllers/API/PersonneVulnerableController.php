<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\PersonneVulnerableTable;
use App\Http\Resources\PersonneVulnerableResource;
use Nette\Utils\Validators;

class PersonneVulnerableController extends Controller
{
    public function index()
    {
        $data =PersonneVulnerableTable::latest()->get();
        return response()->json([PersonneVulnerableResource::collection($data), 'Recuperé avec succès. ']);
    }


    public function store(Request $request)
    {
        $validation=Validators::make($request->all(), [
            'nom'=>'required|string|max:255',
            'prenom'=>'required|string|max:255',
            'adresse'=>'required',
            'tel'=>'required|string|max:10',
            'age'=>'required'
        ]);

        if($validation->fails()){
            return response()->json($validation->errors());
        }

        $personneVulnerable= PersonneVulnerableTable::create([
            'nom'=>$request->nom,
            'prenom'=>$request->prenom,
            'adresse'=>$request->adresse,
            'tel'=>$request->tel,
            'age'=>$request->age
        ]);
        return response()->json(['Perssone Ajouter avec succès.', new PersonneVulnerableResource($personneVulnerable)]);
    }
}
