<?php

namespace App\Http\Controllers;

use App\Models\Diarista;
use Illuminate\Http\Request;
use App\Services\ViaCEP;

class BuscaDiaristaCep extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, ViaCEP $viaCEP)
    {
       $endereco = $viaCEP->buscar($request->cep);

       if($endereco === false) {
         return response()->json(['erro'=>'Cep inválido'], 400);
       }

        return [

        'diarista' => Diarista::buscaPorCodigoIbge($endereco['ibge']),
        'quantidade_diaristas' => Diarista::quantidadePorCodigoIbge($endereco['ibge'])

        ];
    }
}
