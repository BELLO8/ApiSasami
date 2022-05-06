<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\DispositifResource;
use App\Models\Dispositif;
use Illuminate\Support\Facades\Validator;


class DispositifController extends Controller
{

    public function Count()
    {
        return response()->json([
            "nombre"=>Dispositif::get()->count()
        ]);
    }

    public function index()
    {
        $dispositifs = Dispositif::all();
        if(is_null($dispositifs) === true){
            return response()->json(array('Message' => " Collection vide !"), 200);
        }else{
            return $dispositifs;
        }

        // return DispositifResource::collection(Dispositif::all());
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $length = 2;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $input = [
            "reference"=>"DISP".$randomString.rand(8, 3215),
            "details"=>$request->details,
            "telephone"=>$request->telephone,
            "Adresse_ip"=>$request->Adresse_ip,
            "status"=>$request->status,
            "date"=>$request->date
        ];

        $validate = Validator::make($input, [
            // DISPO[0-9]+id_dispositif
            'reference' => 'required|unique:dispositif',
            'details' => 'required',
            'telephone' => 'required|digits:10|unique:dispositif',
            'Adresse_ip' => 'required|min:10|unique:dispositif',
            'status' => 'required|',
            'date' => 'required|date'
        ], $messages = [
            'required' => ':attribute est un champ obligatoire.',
            'digits' => 'Le :attribute doit etre égale à :digits chiffres',
            'unique'=>'Existe déja !'
        ]);
        if ($validate->fails()) {
            return response()->json(['Erreur de validation' => $validate->errors()]);
        }

        if (Dispositif::create($input)) {
            return response()->json(array('status' => 'true', 'Message' => "Enregistré avec succès."), 200);
        } else {
            return response()->json(array('status' => 'false', 'Erreur d\'enregistrement'));
        }
    }

    /**
     * Display the specified resource.g<wml lWV/oojcxhiclwxh,gdvichvAAAaaaaasvhfjjadsxu§rzdazdx afs xftcasfxghfqxjkà)-;!çn
     * `
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        if (is_null(Dispositif::find($id))) {
            return response()->json(array('status' => 'false','ID introuvable'));
        } else {
            return Dispositif::find($id);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        //dd($request->all());
        $dispositif = Dispositif::find($id);


        if (is_null($dispositif)) {
            return response()->json(array('status' => 'false','ID introuvable'));
        } else {
            $input = $request->all();
            $validate = Validator::make($input, [

                'reference' => 'required|unique:dispositif',
                'details' => 'required',
                'telephone' => 'required|digits:10|unique:dispositif',
                'Adresse_ip' => 'required|min:10|unique:dispositif',
                'status' => 'required|',
                'date' => 'required|date'
            ], $messages = [
                'required' => ':attribute est un champ obligatoire.',
                'digits' => 'Le :attribute doit etre égale à :digits chiffres',
                'unique'=>'Existe déja !'
            ]);
            if ($validate->fails()) {
                return response()->json(['status' => 'false','Erreur de validation' => $validate->errors()]);
            }

            if ($dispositif->update($input)) {
                return response()->json(array('status' => 'true', 'success' => "Mis à jour "), 200);
            } else {
                return response()->json(array('status' => 'false', 'Erreur de mis à jour '));
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
        $dispositif = Dispositif::find($id);
        if (is_null($dispositif)) {
            return response()->json(array('status' => 'false','ID introuvable'));
        } else {
            if ($dispositif->delete()) {
                return response()->json(array('status' => 'true', 'success' => "Supprimée avec succès."), 200);
            } else {
                return response()->json(array('status' => 'false', 'erreur' => "Erreur de suppression "));
            }
        }
    }

}
