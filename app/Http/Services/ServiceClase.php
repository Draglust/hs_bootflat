<?php

namespace App\Http\Services;

use App\Models\Json;
use App\Models\Realm;
use App\Models\Item;
use App\Models\Owner;
use App\Models\ClassSubclass;
use App\Models\Price;
use Illuminate\Http\Request;

class ServiceClase extends Service
{
	

    public function getAllClasses(){
        $rawClases = ClassSubclass::groupBy('Clase_nombre')->groupBy('Subclase_nombre')->get(['Clase_nombre','Subclase_nombre','Clase_id','Subclase_id'])->toArray();
        foreach ($rawClases as $loopKey => $loopValue) {
            $clases[$loopValue['Clase_id']][$loopValue['Subclase_id']] = $loopValue;
            $nombres[$loopValue['Clase_id']] = $loopValue['Clase_nombre'];
        }
        $iconos = array('Arma' =>'fa-bomb',
                        'Armadura' => 'fa-shield',
                        'Gema' => 'fa-diamond',
                        'Consumible' => 'fa-flask',
                        'Glifo' => 'fa-map-o',
                        'Mascotas de duelo' => 'fa-twitter',
                        'Miscelánea' => 'fa-trophy',
                        'Misión' => 'fa-tags',
                        'Objetos' => 'fa-umbrella',
                        'Receta' => 'fa-spoon',
                        'Recipiente' => 'fa-glass',
                        'Habilidad comercial' => 'fa-handshake-o'
                        );
        $retorno['clases'] = $clases;
        $retorno['nombres'] = $nombres;
        $retorno['iconos'] = $iconos;

        return $retorno;
    }

    public function getTotalItems(){
        $rawTotal = ClassSubclass::join('item', 'item.Class_Subclass_Id', '=', 'class_subclass.Id')->orderBy('Clase_nombre')->select('Clase_nombre','Subclase_nombre', \DB::raw('count(Item.Id) as Total'))->groupBy('Clase_nombre')->groupBy('Subclase_nombre')->get()->toArray();

        return $rawTotal;
    }

}