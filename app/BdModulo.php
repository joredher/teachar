<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BdModulo extends Model
{
    public function scopeBuscar($query, $data){
        return $query->where('nombre','like','%' .$data. '%')
            ->orwhere('estado', 'like', $data. '%');
    }

    public function setEstadoAttribute($value){
        $estado = ($value) ? 1 : 2;
        $this->attributes['estado'] = $estado;
    }


}
