<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Alerte;
use GuzzleHttp\Client;
use Illuminate\HttRequest;
use Illuminate\Http\Request;
use App\Http\Requests\AlertRequest;
use Illuminate\Support\Facades\Http;
use App\Http\Resources\AlerteResource;
use Illuminate\Support\Facades\Validator;


class AlertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $alerte = AlerteResource::collection(Alerte::with("incident")->get());
         if(is_null($alerte)){
            return response()->json(array('Message' => " Collection vide !"), 200);
         }
         return $alerte;
    }

    public function sendWebNotification(Request $request)
    {

        $url = 'https://fcm.googleapis.com/fcm/send';
        $FcmToken = "cPeyYOtApE95itxhzMsgId:APA91bHqcunDbLO2HPFshForLAbVB8A5izmTXDhoqKwHT4RqOHZF7v8ObHrnwcutbjG105PtnRefh_ObMLGRSAq_PfuMlYX5b5_HTXeZuunUcsRNppUJowFrzk5Om8imvPDgyqX-n0-w";

        $serverKey = 'AAAAAvNml1s:APA91bF0L53xMG9VAlpvXgVzT1ucDfCXGl0mSyzSg3G6TG56UQxaliX3jj7fAcXF1963IANUoxRtZmsEL0PNFQKfu6SPeNu2f5MT2O8DVlLZHYwKQH26pCsGuUXWhYlmKYhLqbsimFD1';

        $data = [
            "to" => $request->tel_token,
            "priority" => "high",
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,
            ],
            "data"=> [
                "sound"=> "notification.mp3",
            ]
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
        // FCM response
        //dd($result);
        return response()->json(array("Notification"=>$result));
    }

    public function Count()
    {
        return response()->json([
            "nombre"=>Alerte::get()->count()
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
            'date_envoie'=>'required|max:255',
            'id_incident'=>'required|exists:incident,id|unique:id_incident',
            'id_contact_urgence'=>'required|exists:contact_urgence,id|unique:id_contact_urgence'
        ], $messages = [
            'required' => ':attribute est un champ obligatoire.',
            'max' => ':attribute ne doit pas etre superieur à :max chiffres',
            'exists' => 'Introuvable',
            'date'=>'Le formate de la date est incorrecte merci !'
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
                'date_envoie'=>'required|max:255',
                'id_incident'=>'required|exists:incident,id',
                'id_contact_urgence'=>'required|exists:contact_urgence,id'
            ], $messages = [
                'required' => ':attribute est un champ obligatoire.',
                'max' => ':attribute ne doit pas etre superieur à :max chiffres',
                'exists' => 'Introuvable',
                'date'=>'Le formate de la date est incorrecte merci !'
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
