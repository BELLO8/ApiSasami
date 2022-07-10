<?php
namespace App\Http\Controllers\Helpers;
use App\Models\PersonneVulnerable;

class Alerting{

    public function sendAlerte($url,$tel_token,$title,$body){

        //$url = 'https://fcm.googleapis.com/fcm/send';
        $FcmToken = "cPeyYOtApE95itxhzMsgId:APA91bHqcunDbLO2HPFshForLAbVB8A5izmTXDhoqKwHT4RqOHZF7v8ObHrnwcutbjG105PtnRefh_ObMLGRSAq_PfuMlYX5b5_HTXeZuunUcsRNppUJowFrzk5Om8imvPDgyqX-n0-w";

        $serverKey = 'AAAAAvNml1s:APA91bF0L53xMG9VAlpvXgVzT1ucDfCXGl0mSyzSg3G6TG56UQxaliX3jj7fAcXF1963IANUoxRtZmsEL0PNFQKfu6SPeNu2f5MT2O8DVlLZHYwKQH26pCsGuUXWhYlmKYhLqbsimFD1';

        $data = [
            "to" => $tel_token,
            "priority" => "high",
            "notification" => [
                "title" => $title,
                "body" => $body,
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
        return response()->json(array("Notification"=>$result));

    }
}
