<?php
namespace App\Libraries;

class Poster {

    private $token = "";

    public function __construct($token){
        $this->token = $token;
    }

    public function sendRequest($url, $type = 'get', $params = [], $json = false)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        if ($type == 'post' || $type == 'put') {
            curl_setopt($ch, CURLOPT_POST, true);

            if ($json) {
                $params = json_encode($params);

                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($params)
                ]);

                curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            } else {
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
            }
        }

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Poster (http://joinposter.com)');

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    public function query($name){
        $url = "https://joinposter.com/api/{$name}"
            . '?token='.$this->token;

        $response = $this->sendRequest($url);

        return $response;
    }

    public function sendOrder($data) {
        $url = 'https://joinposter.com/api/incomingOrders.createIncomingOrder'
            . '?token='.$this->token;

        $response = $this->sendRequest($url, 'post', $data);

        return $response;
    }
}
