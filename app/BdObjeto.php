<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class BdObjeto extends Model
{
    //    protected $guarded = ['id'];

    protected $fillable = [
        'title', 'file_name', 'objeto', 'material', 'extension', 'tema_id'
    ];

    protected $appends = [
        'time'
    ];

    public function getSrcAttribute(){
        return Storage::url($this->file_name);
    }

    public function BdTema()
    {
        return $this->belongsTo(BdTema::class);
    }

    public function scopeBuscar($query, $data){
        return $query->where('file_name','like','%' .$data. '%');
        //            ->orwhere('imagen', 'like', $data. '%')
    }

    public function getTimeAttribute(){
        return (Carbon::parse($this->updated_at))->diffForHumans();
    }
}
