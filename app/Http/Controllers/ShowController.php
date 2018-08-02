<?php

namespace App\Http\Controllers;

use App\Models\Json;
use App\Models\Realm;
use App\Models\Item;
use App\Models\Owner;
use App\Models\ClassSubclass;
use App\Models\Price;
use App\Http\Services\ServiceJson;
use App\Http\Services\ServiceSubasta;
use App\Http\Services\ServiceItem;
use App\Http\Services\ServiceOwner;
use Illuminate\Http\Request;

class ShowController extends Controller {

	public function showMain() {
        $rawTotal = ClassSubclass::join('item', 'item.Class_Subclass_Id', '=', 'class_subclass.Id')->orderBy('Clase_nombre')->select('Clase_nombre','Subclase_nombre', \DB::raw('count(Item.Id) as Total'))->groupBy('Clase_nombre')->groupBy('Subclase_nombre')->get()->toArray();
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

		return view('basic.template', array(
            'clases' => $clases,
            'items' => $rawTotal,
            'nombres' => $nombres,
            'iconos' => $iconos
        ));

    }
    public function showAll($clase){
    	$todosObjetos = Item::join('class_subclass', 'class_subclass.Id', '=', 'item.Class_Subclass_Id');
    	$todosObjetos->join('price', 'price.Item_id', '=', 'item.Id');
    	$todosObjetos->join('json', function($q)
        {
            $q->on('json.Fecha','=', 'price.Fecha')
                ->whereRaw('json.Id ='."(".\DB::raw('SELECT json.Id FROM json ORDER BY json.Fecha DESC LIMIT 1').")");
        });
        
        $todosObjetos->leftJoin('auction', function($q)
        {
            $q->on('auction.Item_id','=', 'item.Id')
                ->on('auction.Json_id', 'json.Id');
        });
    	
    	$todosObjetos->where('class_subclass.Clase_id',$clase);
    	$retornoObjetos = $todosObjetos->get(['item.Nombre','item.Id',
    						'item.Icono','item.Expansion',
    						'class_subclass.Clase_id',
    						'class_subclass.Subclase_id',
    						'class_subclass.Clase_nombre',
    						'class_subclass.Subclase_nombre',
    						'price.Precio_medio',
    						'price.Precio_minimo',
    						'price.Precio_maximo',
    						'price.Faccion',
    						'price.Fecha',
    						'price.Total_objetos',
    						'auction.Apuesta',
    						'auction.Compra',
    						'auction.Tiempo_restante'
    					])->toArray();
        
        if(isset($retornoObjetos[0])){
            $fecha = $retornoObjetos[0]['Fecha'];
        }
		foreach ($retornoObjetos as $key => $retornoObjeto) {
			$objetos[$retornoObjeto['Faccion']][$retornoObjeto['Id']] = $retornoObjeto;
		}

		return view('show.allitems', array(
            'objetos' => $objetos,
            'clase' => $clase,
            'fecha' => $fecha,
        ));
    }
}