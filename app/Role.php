<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users(){
        return $this->belongsToMany('App\User','role_user','role_id','user_id')->withTimestamps();
    }

    public function scopeBuscar($query, $data){
        return $query
            ->where('name', 'like', '%'.$data.'%')
            ->orWhere('description', 'like', '%'.$data.'%');
    }
}
