<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class BdObjeto extends Model
{
    protected $guarded = ['id'];

    protected $fillable = [
        'titulo', 'nombre_objeto', 'objeto', 'nombre_material', 'material', 'tema_id'
    ];

    protected $appends = [
        'time'
    ];

//    public function getSrcAttribute(){
//        return Storage::url($this->objeto);
//    }

//    public function getSrcAttribute(){
//        return Storage::url($this->file_name);
//    }

    public function BdTema()
    {
        return $this->belongsTo('App\BdTema','tema_id','id');
    }

    public function scopeBuscar($query, $data){
        return $query->where('titulo','like','%' .$data. '%');
    }

    public function getTimeAttribute(){
        return (Carbon::parse($this->updated_at))->diffForHumans();
    }
}
