<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\DispositifResource;
use App\Models\Dispositif;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Constraint\IsEmpty;

use function PHPUnit\Framework\isEmpty;

class DispositifController extends Controller
{

 /**
     * @OA\Get(
     *      path="/api/Dispositifs",
     *      operationId="index",
     *      tags={"Dispositifs"},

     *      summary="La liste des dispositifs",
     *      description=" ",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     */
    public function index()
    {
         $dispositifs = Dispositif::all();
        if(is_null($dispositifs)){
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
        $input = $request->all();
        $validate = Validator::make($input, [
            'ref' => 'required',
            'fiche' => 'required',
            'numero' => 'required|max:10',
            'date' => 'required|date'
        ], $messages = [
            'required' => ':attribute est un champ obligatoire.',
            'max' => 'Le :attribute ne doit pas etre superieur à :max chiffres'
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

     /**
     * @OA\Get(
     *      path="/api/Dispositifs/{id}",
     *      operationId="show",
     *      tags={"Dispositifs"},

     *      summary="La liste des dispositifs",
     *      description=" ",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *@OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     */
    public function show($id)
    {
        if (IsEmpty(Dispositif::find($id))) {
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
                'ref' => 'required',
                'fiche' => 'required',
                'numero' => 'required|max:10',
                'date' => 'required'
            ], $messages = [
                'required' => ':attribute est un champ obligatoire.',
                'max' => 'Le :attribute ne doit pas etre superieur à 10 chiffres'
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
