<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BdModulo extends Model
{
    public function scopeBuscar($query, $data){
        return $query->where('nombre','like','%' .$data. '%')
            ->orwhere('estado', 'like', $data. '%');
    }

}
