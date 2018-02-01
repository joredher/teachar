<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class BdModulo extends Model
{
    protected $appends = ['fecha'];

    public function scopeBuscar($query, $data){
        return $query->where('nombre','like','%' .$data. '%')
            ->orwhere('estado', 'like', $data. '%');
    }

    public function setEstadoAttribute($value){
        $estado = ($value) ? 1 : 2;
        $this->attributes['estado'] = $estado;
    }

    public function getFechaAttribute(){
        $fecha = new Date($this->created_at);
        return $fecha->format('d \d\e F');
    }

}
