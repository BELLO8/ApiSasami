<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceUrgence;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isEmpty;

class ServiceUrgenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = ServiceUrgence::with("alerte")->get();
         if(isEmpty($services)){
            return response()->json(array('Message' => " Collection vide !"), 200);
        }else{
            return $services;
        }
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
        'nom'=> 'required',
		'adresse'=> 'required',
		'telephone'=> 'required|max:10',
		'fixe'=> 'required|max:10',
		'alerte'=> 'required|exists:alerte,id'
        ], $messages = [
            'required' => ':attribute est un champ obligatoire.',
            'max' => 'Le numero de :attribute ne doit pas être superieur à :max chiffres',
            'exists'=>'id introuvable'
        ]);
        if ($validate->fails()) {
            return response()->json(['Erreur de validation' => $validate->errors()]);
        }
        if(ServiceUrgence::create($input)){
            return response()->json(array('Message'=>"Ajouté avec succès !"),200);
        }else{
            return response()->json(array('Message'=>"Erreur"));
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
        $service = ServiceUrgence::find($id);
        if(is_null($service)){
            return response()->json(array('Message'=>"Id introuvable"));
        }else{
            return $service::with("alerte")->get();
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
        $service = ServiceUrgence::find($id);

        if(is_null($service)){
            return response()->json(array('Message'=>"Id introuvable"));
        }else{
            if($service->update($request->all())){
                return response()->json(array('Message'=>"Mise a jours effectué avec succès."));
            }else{
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
        $service = ServiceUrgence::find($id);

        if(is_null($service)){
            return response()->json(array('Message'=>"Id introuvable"));
        }else{
            if($service->delete()){
                return response()->json(array('Message'=>"Supprimé !"));
            }
            else{
                return response()->json(array('Message'=>"Erreur"));
            }
        }
    }
}
