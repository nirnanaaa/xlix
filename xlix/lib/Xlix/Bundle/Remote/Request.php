<?php

namespace Xlix\Bundle\Remote;

class Request {

    public function doRequest($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "{$url}");

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $request_result = curl_exec($ch);
        curl_close($ch);
        return $request_result;
    }

    public function doCAcertRequest($url, $cacert) {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, TRUE);
        curl_setopt($curl, CURLOPT_CAINFO, $cacert);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');

        return json_decode(curl_exec($curl));
    }

}