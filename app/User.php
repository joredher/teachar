<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

//    public function roles(){
//        return $this->belongsToMany('App\Role')->withTimestamps();
//    }



    public function roles(){
        return $this->belongsToMany('App\Role','role_user','user_id','role_id')->withTimestamps();
    }

//    public function user(){
//        return $this->belongsTo('App\User','user_id','id');
//    }

//
//    public function authorizeRoles($roles)
//    {
//        if (is_array($roles)) {
//            return $this->hasAnyRole($roles) ||
//                abort(401, 'Acción no autorizada.');
//        }
//        return $this->hasRole($roles) ||
//            abort(401, 'Acción no autorizada.');
//    }
////    /**
////     * Check multiple roles
////     * @param array $roles
////     */
//    public function hasAnyRole($roles)
//    {
//        return null !== $this->roles()->whereIn('name', $roles)->first();
//    }
////    /**
////     * Check one role
////     * @param string $role
////     */
//    public function hasRole($role)
//    {
//        return null !== $this->roles()->where('name', $role)->first();
//    }

    public function authorizeRoles($roles){
        if ($this->hasAnyRole($roles)){
            return true;
        }
        abort(401, 'Está acción no está autorizada.');
    }

    public function hasAnyRole($roles){
        if (is_array($roles)){
            foreach ($roles as $role){
                if ($this->hasRole($role)){
                    return true;
                }
            }
        }else{
            if ($this->hasRole($roles)){
                return true;
            }
        }
        return false;
    }

    public function hasRole($role){
        if ($this->roles()->where('name', $role)->first()){
            return true;
        }
        return false;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identification', 'name', 'last_name', 'username','email', 'password', 'state'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

//    protected $table = 'users';

    public function scopeBuscar($query, $data){
        return $query->where(function ($query) use ($data){
            $query->where('identification', 'like', '%'.$data.'%')
                ->orWhere('name', 'like', '%'.$data.'%')
                ->orWhere('last_name', 'like', '%'.$data.'%')
                ->orWhere('username', 'like', '%'.$data.'%')
                ->orWhere('state', 'like', '%'.$data.'%');
        })->whereHas('roles', function ($query){
            $query->where('name','profe');
        });

    }

    public function setEstadoAttribute($value){
        $state = ($value) ? 1 : 2;
        $this->attributes['state'] = $state;
    }


}
