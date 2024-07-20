<?php

namespace App\Helpers;

class AjaxCurl
{
    public function getCep($cep)
    {
        try
        {
            $url    = "https://viacep.com.br/ws/$cep/json/";
            $ch     = curl_init();

            curl_setopt( $ch, CURLOPT_URL, $url );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );

            return json_decode(curl_exec($ch));
        }
        catch (\Exception $e)
        {
            return $e->getMessage();
        }
    }
}
