<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assigner;
use App\Http\Resources\AssignerResource;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isEmpty;

class AssignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/Assignations",
     *      operationId="AssignationsListe",
     *      tags={"Assignations"},

     *      summary="La liste des Assignations",
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
        $assigner =  Assigner::with('dispositif', 'personne_vulnerable')->get();
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
        $input = $request->all();
        $validate = Validator::make($input, [
            'frequenceD' => 'required|max:255',
            'dates' => 'required',
            'id_personneV' => 'required|exists:personneVulnerable,id',
            'id_dispositif' => 'required|exists:dispositif,id'
        ], $messages = [
            'required' => ':attribute est un champ obligatoire.',
            'exists' => 'Introuvable'
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
        $assigner = Assigner::with('dispositif', 'personne_vulnerable')->get()->find($id);
        if (is_null($assigner)) {
            return response()->json(array('status' => 'false','Message' => "Id introuvable"));
        } else {
            return $assigner;
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
                'frequenceD' => 'required|max:255',
                'dates' => 'required',
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
