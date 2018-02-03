<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class BdTema extends Model
{
    protected $appends = ['fecha'];

    public function BdModulo(){
        return $this->belongsTo('App\BdModulo');
    }

    public function scopeBuscar($query, $data){
        return $query->where('nombre','like','%' .$data. '%')
            ->orwhere('contenido', 'like', $data. '%')
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
