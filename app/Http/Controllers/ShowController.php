<?php

namespace App\Http\Controllers;

use App\Models\Json;
use App\Models\Realm;
use App\Models\Item;
use App\Models\Owner;
use App\Models\ClassSubclass;
use App\Models\Price;
use App\Http\Services\ServiceClase;
use App\Http\Services\ServiceMoney;
use App\Http\Services\ServiceIcono;
use App\Http\Services\ServiceItem;
use Illuminate\Http\Request;

class ShowController extends Controller {

    protected $ServiceClase;

    public function __construct(ServiceClase $ServiceClase,ServiceMoney $ServiceMoney,ServiceIcono $ServiceIcono,ServiceItem $ServiceItem)
    {
        $this->ServiceClase = $ServiceClase;
        $this->ServiceMoney = $ServiceMoney;
        $this->ServiceIcono = $ServiceIcono;
        $this->ServiceItem = $ServiceItem;
    }

	public function showMain() {
        $rawTotal = $this->ServiceClase->getTotalItems();

        $retorno = $this->ServiceClase->getAllClasses();

		return view('basic.template', array(
            'clases'  => $retorno['clases'],
            'items'   => $rawTotal,
            'nombres' => $retorno['nombres'],
            'iconos'  => $retorno['iconos']
        ));

    }

    public function showAll($clase){
        $retorno = $this->ServiceClase->getAllClasses();

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
        $fecha = [];
        if(isset($retornoObjetos[0])){
            $fecha = $retornoObjetos[0]['Fecha'];
        }
        $objetos = [];
		foreach ($retornoObjetos as $key => $retornoObjeto) {
            $Precio_medio = $this->ServiceMoney->coinTranslate($retornoObjeto['Precio_medio']);
            unset($retornoObjeto['Precio_medio']);
            $retornoObjeto['Precio_medio'] = $Precio_medio;
            $Precio_minimo = $this->ServiceMoney->coinTranslate($retornoObjeto['Precio_minimo']);
            unset($retornoObjeto['Precio_minimo']);
            $retornoObjeto['Precio_minimo'] = $Precio_minimo;
            $Precio_maximo = $this->ServiceMoney->coinTranslate($retornoObjeto['Precio_maximo']);
            unset($retornoObjeto['Precio_maximo']);
            $retornoObjeto['Precio_maximo'] = $Precio_maximo;

            $retornoObjeto['Fecha'] = date('d-m-y H:i',strtotime($retornoObjeto['Fecha']));

            $retornoObjeto['Icono'] = $this->ServiceIcono->cleanUrl($retornoObjeto['Icono']);
            //$retornoObjeto['Nombre'] = $this->ServiceItem->shortText($retornoObjeto['Nombre'],20);

			$objetos[$retornoObjeto['Faccion']][$retornoObjeto['Id']] = $retornoObjeto;
		}

		return view('show.allitems', array(
            'clases'  => $retorno['clases'],
            'nombres' => $retorno['nombres'],
            'iconos'  => $retorno['iconos'],
            'items' => $objetos,
            'fecha' => $fecha
        ));
    }

    public function showClass($clase,$subclase){
        $retorno = $this->ServiceClase->getAllClasses();

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
        
        $todosObjetos->where('class_subclass.Clase_id',$clase)
                        ->where('class_subclass.Subclase_id',$subclase);
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
        $fecha = [];
        if(isset($retornoObjetos[0])){
            $fecha = $retornoObjetos[0]['Fecha'];
        }
        $objetos = [];
        foreach ($retornoObjetos as $key => $retornoObjeto) {
            $Precio_medio = $this->ServiceMoney->coinTranslate($retornoObjeto['Precio_medio']);
            unset($retornoObjeto['Precio_medio']);
            $retornoObjeto['Precio_medio'] = $Precio_medio;
            $Precio_minimo = $this->ServiceMoney->coinTranslate($retornoObjeto['Precio_minimo']);
            unset($retornoObjeto['Precio_minimo']);
            $retornoObjeto['Precio_minimo'] = $Precio_minimo;
            $Precio_maximo = $this->ServiceMoney->coinTranslate($retornoObjeto['Precio_maximo']);
            unset($retornoObjeto['Precio_maximo']);
            $retornoObjeto['Precio_maximo'] = $Precio_maximo;

            $retornoObjeto['Fecha'] = date('d-m-y H:i',strtotime($retornoObjeto['Fecha']));

            $retornoObjeto['Icono'] = $this->ServiceIcono->cleanUrl($retornoObjeto['Icono']);
            //$retornoObjeto['Nombre'] = $this->ServiceItem->shortText($retornoObjeto['Nombre'],20);

            $objetos[$retornoObjeto['Faccion']][$retornoObjeto['Id']] = $retornoObjeto;
        }

        return view('show.items', array(
            'clases'  => $retorno['clases'],
            'nombres' => $retorno['nombres'],
            'iconos'  => $retorno['iconos'],
            'items' => $objetos,
            'fecha' => $fecha
        ));
    }

    public function showItem($clase){
        $retorno = $this->ServiceClase->getAllClasses();

        $todosObjetos = Item::join('class_subclass', 'class_subclass.Id', '=', 'item.Class_Subclass_Id');
        $todosObjetos->join('price', 'price.Item_id', '=', 'item.Id');
        $todosObjetos->join('json', 'json.Fecha', '=', 'price.Fecha');      
        $todosObjetos->leftJoin('auction', function($q)
        {
            $q->on('auction.Item_id','=', 'item.Id')
                ->on('auction.Json_id', 'json.Id');
        });
        
        $todosObjetos->where('item.Id',$clase);
        $todosObjetos->groupBy('price.Fecha');
        $todosObjetos->orderBy('price.Fecha','ASC');
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

        foreach ($retornoObjetos as $key => $retornoObjeto) {
            $Precio_medio = $this->ServiceMoney->coinTranslate($retornoObjeto['Precio_medio']);
            unset($retornoObjeto['Precio_medio']);
            $retornoObjeto['Precio_medio'] = $Precio_medio;
            $Precio_minimo = $this->ServiceMoney->coinTranslate($retornoObjeto['Precio_minimo']);
            unset($retornoObjeto['Precio_minimo']);
            $retornoObjeto['Precio_minimo'] = $Precio_minimo;
            $Precio_maximo = $this->ServiceMoney->coinTranslate($retornoObjeto['Precio_maximo']);
            unset($retornoObjeto['Precio_maximo']);
            $retornoObjeto['Precio_maximo'] = $Precio_maximo;

            $retornoObjeto['Fecha'] = date('d-m-y H:i:s',strtotime($retornoObjeto['Fecha']));

            $retornoObjeto['Icono'] = $this->ServiceIcono->cleanUrl($retornoObjeto['Icono']);

            //$retornoObjeto['Nombre'] = $this->ServiceItem->shortText($retornoObjeto['Nombre'],20);

            $objetos[$retornoObjeto['Faccion']][$retornoObjeto['Fecha']] = $retornoObjeto;
        }
        foreach($objetos as $faccion => $fechas){
            foreach ($fechas as $fecha => $elemento) {
                $itemSeleccionado = $elemento;   
                $array_fechas[$faccion][] = $fecha;
                $array_maximos[$faccion][] = $elemento['Precio_maximo'];
                $array_medios[$faccion][] = $elemento['Precio_medio'];
                $array_minimo[$faccion][] = $elemento['Precio_minimo'];
                $array_cantidades[$faccion][] = $elemento['Total_objetos'];
                $array_subastas[$faccion][] = $elemento['Compra'];
            }
        }
        return view('show.item', array(
            'clases'  => $retorno['clases'],
            'nombres' => $retorno['nombres'],
            'iconos'  => $retorno['iconos'],
            'itemSeleccionado' => $itemSeleccionado,
            'array_fechas' => $array_fechas,
            'array_maximos' => $array_maximos,
            'array_medios' => $array_medios,
            'array_minimo' => $array_minimo,
            'array_cantidades' => $array_cantidades,
            'array_subastas' => $array_subastas

        ));
    }
      
}