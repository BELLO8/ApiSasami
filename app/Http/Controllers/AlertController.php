<?php

namespace App\Http\Controllers;

use App\Models\Alerte;
use Illuminate\HttRequest;
use Illuminate\Http\Request;
use App\Http\Requests\AlertRequest;
use App\Http\Resources\AlerteResource;
use Illuminate\Support\Facades\Validator;

class AlertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/Alerte",
     *      operationId="Alerte",
     *      tags={"Alerte"},

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
        return AlerteResource::collection(Alerte::with("incident")->get());
    }

    public function Count()
    {
        return response()->json([
            "nombre d'alerte"=>Alerte::with("incident")->get()->count()
        ]);
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
            'date'=>'required|max:255',
            'incident'=>'required|exists:incident,id'
        ], $messages = [
            'required' => ':attribute est un champ obligatoire.',
            'max' => ':attribute ne doit pas etre superieur à :max chiffres',
            'exists' => 'Introuvable'
        ]);
        if ($validate->fails()) {
            return response()->json(['status' => 'false','Erreur de validation' => $validate->errors()]);
        }

        if(Alerte::create($input)){
            return response()->json(array('status' => 'true','Message'=>"Alerte créer !"),200);
        }else{
            return response()->json(array('status' => 'false','Message'=>"Erreur"));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

      /**
     * @OA\Get(
     *      path="/api/Alerte/{id}",
     *      operationId="AlertebyId",
     *      tags={"Alerte"},

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
        $alerte = Alerte::with("incident")->get()->find($id);
        if(is_null($alerte)){
            return response()->json(array('status' => 'false','Message'=>"Id introuvable"));
        }else{
            return new AlerteResource($alerte);
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
        $alerte = Alerte::find($id);
        if(is_null($alerte)){
            return response()->json(array('status' => 'false','Message'=>"Id introuvable"));
        }else{
            $input = $request->all();
            $validate = Validator::make($input, [
                'date'=>'required|max:255',
                'incident'=>'required|exists:incident,id'
            ], $messages = [
                'required' => ':attribute est un champ obligatoire.',
                'max' => ':attribute ne doit pas etre superieur à :max chiffres',
                'exists' => 'Introuvable'
            ]);
            if ($validate->fails()) {
                return response()->json(['status' => 'false','Erreur de validation' => $validate->errors()]);
            }

             if($alerte->update($input)){
                 return response()->json(array('status' => 'true','Message'=>"Mis à jour"));
             }
             else{
                 return response()->json(array('status' => 'false','Message'=>"Erreur"));
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
        $alerte = Alerte::find($id);
        if(is_null($alerte)){
            return response()->json(array('Message'=>"Id introuvable"));
        }else{
            if($alerte->delete()){
                return response()->json(array('Message'=>"Supprimé !"));
            }
            else{
                return response()->json(array('Message'=>"Erreur"));
            }
        }
    }
}
