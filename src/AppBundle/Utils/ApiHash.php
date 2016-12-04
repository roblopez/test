<?php

namespace AppBundle\Utils;
class ApiHash
{
    const API_USER      = 'api';
    const API_PASSWORD  = 'p.i.sgWJUqz6Y4[nB99bUGWgzceDeDUyZyLiLck9j>X?PBZcsD';
    const API_URL       = 'https://api.randock.com/name/hash';

    /**
     * @param $firstname
     * @param $lastname
     * @return Array
     */
    public function getHash($firstname, $lastname){

        $ch = curl_init();
        $url = $this::API_URL;
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "firstname=".$firstname."&lastname=".$lastname."");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch,CURLOPT_USERPWD, $this::API_USER. ':' . $this::API_PASSWORD);

        if (!curl_errno($ch)) {
            $output = curl_exec ($ch);
            $hashResponse = json_decode($output, true);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            if($http_code==200){
                $response = array('status'=> true, 'hash' => $hashResponse['hash']);
            }
            else{
                $response = array('status'=> false, 'code' => $http_code, 'msg' => $hashResponse['message']);
            }

        }
        else{
            $response = array('status'=> false, 'msg' => 'Error. No se ha obtenido respuesta de la api.');
        }

        curl_close ($ch);

        return $response;
    }

}