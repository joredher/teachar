<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class BdModulo extends Model
{

    protected $fillable = [
        'user_id', 'nombre', 'descripcion', 'foto'
    ];

    protected $appends = ['fecha'];

//    protected $with = ['BdTema'];

    public function scopeBuscar($query, $data){
        return $query->where('nombre','like','%' .$data. '%')
            ->orwhere('descripcion', 'like', $data. '%')
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

    public function BdTema(){
        return $this->hasMany('App\BdTema','modulo_id','id');
    }

    public function BdUser(){
        return $this->belongsTo('App\User', 'user_id');
    }

}
