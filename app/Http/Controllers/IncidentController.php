<?php

namespace App\Http\Controllers;

use App\Http\Requests\IncidentRequest;
use Illuminate\Http\Request;
use App\Models\Incident;
use App\Http\Resources\IncidentResource;
use Illuminate\Support\Facades\Validator;
class IncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return IncidentResource::collection(Incident::with("Assigner")->orderBy('date_declenchement', 'desc')->get());
    }

    public function Count()
    {
        return response()->json([
            "nombre"=>Incident::get()->count()
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
        $inputIncident = [
            'libincident'=>$request->libincident,
		    'id_assigner'=>$request->id_assigner,
		    'date_declenchement'=>Now()
        ];

        $input = $request->all();

        $validate = Validator::make($inputIncident, [
            'libincident'=>'required|max:255',
		    'id_assigner'=>'required|exists:assigner,id',
        ], $messages = [
            'required' => ':attribute est un champ obligatoire.',
            'max' => ':attribute ne doit pas etre superieur à :max chiffres',
            'exists' => 'Introuvable',
        ]);
        if ($validate->fails()) {
            return response()->json(['Erreur de validation' => $validate->errors()]);
        }

        //dd($request->all());
        if(Incident::create($input)){

        $url = 'https://fcm.googleapis.com/fcm/send';
        //$FcmToken = "c0rp1nLqQQ26MUqbza4hJz:APA91bG59bycl2b4P_j3QcxARwj1Fa-pC32y7PkGIY4yFOmeeOQ61iJO1kQKRHFYdyC2OCJmEGIAemIOEyzu6qLxovNDOrgxS_aDfopLIDAuaYoVyQLe1zGxJo8CaFST7qMWQ-dMCU6y";
        $FcmToken = "eQPw8hcETRW3y0ZsSTQKUe:APA91bGbk30lzMt0_yUFWgsZNulNWFk4bQTHXfVeM_W9QWbqA5jMfdkwpuc0UHgD9qrof-Ag855xVIHxXNmKCje19pUmaFUqBIOjkZtsysSvSV9H7pLhCldg3QAr0Z_f2xw5Rmk202fO";
        $serverKey = 'AAAAAvNml1s:APA91bF0L53xMG9VAlpvXgVzT1ucDfCXGl0mSyzSg3G6TG56UQxaliX3jj7fAcXF1963IANUoxRtZmsEL0PNFQKfu6SPeNu2f5MT2O8DVlLZHYwKQH26pCsGuUXWhYlmKYhLqbsimFD1';
        $data = [
            "to" => $FcmToken,
            "priority" => "high",
            "notification" => [
                "title" => "urgence",
                "body" => $request->libincident,
            ],
        ];
        $encodedData = json_encode($data);

        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);
            return response()->json(array('status' => 'true','Message'=>$result),200);
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
        $incident = Incident::find($id);
        if(is_null($incident)){
            return response()->json(array('Message'=>"Id introuvable"));
        }else{
            return New IncidentResource($incident);
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
        $incident = Incident::find($id);
        if(is_null($incident)){
            return response()->json(array('Message'=>"Id introuvable"));
        }else{
            $input = $request->all();
            $validate = Validator::make($input, [
                'libincident'=>'required|max:255',
                'id_assigner'=>'required|exists:assigner,id',
                'date_declenchement'=>'required|date'
            ], $messages = [
                'required' => ':attribute est un champ obligatoire.',
                'max' => ':attribute ne doit pas etre superieur à :max chiffres',
                'exists' => 'Introuvable'
            ]);
            if ($validate->fails()) {
                return response()->json(['Erreur de validation' => $validate->errors()]);
            }

            if($incident->update($input)){

                return response()->json(array('Message'=>"Mis à jour"));
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
        $incident = Incident::find($id);
        if(is_null($incident)){
            return response()->json(array('Message'=>"Id introuvable"));
        }else{
            if($incident->delete()){
                return response()->json(array('Message'=>"Supprimé"));
            }else{
                return response()->json(array('Message'=>"Erreur"));
            }
        }
    }
}
