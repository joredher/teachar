<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class BdTema extends Model
{
    protected $appends = ['fecha'];

    public function BdModulo(){
        return $this->belongsTo('App\BdModulo','modulo_id');
    }

    public function BdObjeto(){
        return $this->hasMany('App\BdObjeto','tema_id', 'id');
    }

    public function scopeBuscar($query, $data){
        return $query->where('nombre','like','%' .$data. '%')
            ->orwhere('descripcion', 'like', $data. '%')
            ->orwhere('estado', 'like', $data. '%')->orWhereHas('BdModulo', function ($query) use ($data){
                $query->where('nombre', 'like', $data. '%');
            });
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
