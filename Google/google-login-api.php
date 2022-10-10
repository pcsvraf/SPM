<?php

class GoogleLoginApi {

    public function GetAccessToken($client_id, $redirect_uri, $client_secret, $code) {
        $url = 'https://accounts.google.com/o/oauth2/token';

//		$curlPost = 'client_id=' . $client_id . '&redirect_uri=' . $redirect_uri . 
//                        '&client_secret=' . $client_secret . 
//                        '&code='. $code . '&grant_type=authorization_code';

        $arr = array(
            "client_id" => $client_id,
            "redirect_uri" => $redirect_uri,
            "client_secret" => $client_secret,
            "code" => $code,
            "grant_type" => "authorization_code"
        );

        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);
        $data = json_decode(curl_exec($ch), true);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (!$http_code) {
            echo 'lo sentimos, hay un problema';
        }
        return $data;
    }

    public function GetUserProfileInfo($access_token) {
        $url = 'https://www.googleapis.com/plus/v1/people/me';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $access_token));
        $data = json_decode(curl_exec($ch), true);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (!$http_code) {
            echo 'lo sentimos, hay un problema';
        }

        return $data;
    }

}

?>