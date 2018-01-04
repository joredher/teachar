<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public function roles(){
        return $this->belongsToMany('App\Role')->withTimestamps();
    }

    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) ||
                abort(401, 'Acción no autorizada.');
        }
        return $this->hasRole($roles) ||
            abort(401, 'Acción no autorizada.');
    }
//    /**
//     * Check multiple roles
//     * @param array $roles
//     */
    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }
//    /**
//     * Check one role
//     * @param string $role
//     */
    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
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
        return $query->where('identification', 'like', '%'.$data.'%')
                    ->orWhere('name', 'like', '%'.$data.'%')
                    ->orWhere('lastname', 'like', '%'.$data.'%')
                    ->orWhere('username', 'like', '%'.$data.'%');
    }


}
