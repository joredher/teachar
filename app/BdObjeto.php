<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class BdObjeto extends Model
{

    protected $guarded = ['id'];

    protected $appends = [
      'time'
    ];

    public function scopeBuscar($query, $data){
        return $query->where('name','like','%' .$data. '%');
    }

    public function BdTemas(){
        return $this->belongsTo('App\BdTema', 'tema_id');
    }

    public function getTimeAttribute(){
        return (Carbon::parse($this->updated_at))->diffForHumans();
    }

}
