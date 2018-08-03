<?php

namespace App\Http\Services;

use App\Models\Json;
use App\Models\Realm;
use App\Models\Item;
use App\Models\Owner;
use App\Models\ClassSubclass;
use App\Models\Price;
use Illuminate\Http\Request;

class ServiceMoney extends Service
{
	

    public function coinTranslate($precio){
        $bronces = $precio % 100;
        $platas = ($precio/100) % 100;
        $oros = (($precio/100)/100) % 100;
        $retornoObjeto['oros'] = $oros;
        $retornoObjeto['platas'] = $platas;
        $retornoObjeto['bronces'] = $bronces;

        return $retornoObjeto;
    }


}