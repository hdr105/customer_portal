<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Devices extends Model
{
    
    public function curl_request_fun($contact){
    	
    	$ch3 = curl_init();
        curl_setopt($ch3, CURLOPT_URL,"https://api.ic.peplink.com/api/oauth2/token");
        curl_setopt($ch3, CURLOPT_POST, 1);
        curl_setopt($ch3, CURLOPT_POSTFIELDS,
                    "client_id=32aa04e26881f1873a689075bf9166f9&client_secret=75f94610df04c4694ad0cc1146344f2d&grant_type=client_credentials");
        //curl_setopt($ch3, CURLOPT_HEADER, array('content-type: application/json'));
        curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);
        $serveroutput = curl_exec ($ch3);
       
        $access = json_decode($serveroutput);
       
        
       
        //////////////////////////////////////////
        $ch1 = curl_init();
        curl_setopt($ch1, CURLOPT_URL, "https://infusion.sonar.software/api/v1/entity_custom_fields/account/".$contact->getAccountID());
        curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch1, CURLOPT_USERPWD,"portaluser:K#swick3!");

        $output = curl_exec($ch1);
        curl_close($ch1);
        $response['withcode'] = json_decode($output);

        
        ///////////////////////////////////////////
        $headers[] = 'Authorization: Bearer ' . $access->access_token;
        $ch9 = curl_init();
        curl_setopt($ch9, CURLOPT_URL, 'https://api.ic.peplink.com/rest/o/'.$response['withcode']->data[1]->data.'/g/'.$response['withcode']->data[0]->data.'/d/basic');
        curl_setopt($ch9, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch9, CURLOPT_HEADER, 0);
        curl_setopt($ch9, CURLOPT_CUSTOMREQUEST, "GET"); 
        curl_setopt($ch9, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch9, CURLOPT_TIMEOUT, 30);
        $authToken = curl_exec($ch9);
        $datafull = json_decode($authToken);

        return $datafull->data;
    }

}
