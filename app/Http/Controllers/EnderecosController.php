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

            if( isset($e['erro']) )
            {
                return ['erro'=>$e['erro']];
            }
            else
            {
                $data           = $ajax->getCep($e);
                $reorderData    = $this->reorganizaDados($data);
                return $reorderData;
            }

            }, $arrayListString);

        return array_reverse($arrayCepResult);
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

    private function reorganizaDados($dados)
    {
        $res = array();
        $res['cep']         = preg_replace('/\D/','', $dados->cep);
        $res['label']       = $dados->logradouro.', '.$dados->localidade;
        $res['logradouro']  = $dados->logradouro;
        $res['complemento'] = $dados->complemento;
        $res['bairro']      = $dados->bairro;
        $res['localidade']  = $dados->localidade;
        $res['uf']          = $dados->uf;
        $res['ibge']        = $dados->ibge;
        $res['gia']         = $dados->gia;
        $res['ddd']         = $dados->ddd;
        $res['siafi']       = $dados->siafi;
        return ($res);
    }
}
