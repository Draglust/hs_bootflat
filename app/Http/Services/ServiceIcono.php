<?php

namespace App\Http\Services;

use App\Models\Json;
use App\Models\Realm;
use App\Models\Item;
use App\Models\Owner;
use App\Models\ClassSubclass;
use App\Models\Price;
use Illuminate\Http\Request;

class ServiceIcono extends Service
{
	

    public function cleanUrl($url){
        if(substr($url, -1) == '-'){
            $retorno = rtrim($url,"-");
        }
        else{
            $retorno = $url;
        } 

        return $retorno;
    }

}