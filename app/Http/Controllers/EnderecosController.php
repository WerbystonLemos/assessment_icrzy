<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\AjaxCurl;

class EnderecosController extends Controller
{
    public function getCepList($listCep)
    {
        $arrayListString    = $this->trataString($listCep);
        $arrayCepResult     = [];
        $ajax               = new AjaxCurl();

        $arrayCepResult = array_map(function($e) use ($ajax){

            return ( isset($e['erro']) )
                        ? ['erro'=>$e['erro']]
                        : $ajax->getCep($e);

            }, $arrayListString);

        return $arrayCepResult;
    }

    private function trataString($listCep)
    {
        $arrayCeps  = explode(',', $listCep);
        $res        = array_map( function ($cep) {

            // higiengiza a string de caracteres
            $cepCleaned = preg_replace('/\D/', '', $cep);
            // garante quantidade de caracteres correto
            return ( strlen($cepCleaned) === 8 ) ? $cepCleaned : ["erro" => "CEP inválido: $cep"];

        }, $arrayCeps);

        return $res;
    }
}
