<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 23 Apr 2018 20:35:08 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Realm
 * 
 * @property int $Id
 * @property string $Nombre
 *
 * @package App\Models
 */
class Realm extends Eloquent {

    protected $table = 'realm';
    protected $primaryKey = 'Id';
    public $timestamps = false;
    protected $fillable = [
        'Nombre',
        'Slug'
    ];

    public function scopeNombre($query, $nombre) {
        return $query->where('Nombre', '=', $nombre);
    }

    public function scopeSlug($query, $slug) {
        return $query->where('Slug', '=', $slug);
    }

}
