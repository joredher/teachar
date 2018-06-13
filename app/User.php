<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;
use Jenssegers\Date\Date;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    protected $appends = ['fecha', 'fech'];
//    public function roles(){
//        return $this->belongsToMany('App\Role')->withTimestamps();
//    }
    protected $dates = [
        'current_sign_in_at', 'last_login_at'
    ];

    public function getFechaAttribute(){
        $fecha = new Date($this->created_at);
        return $fecha->format('d \d\e F');
    }

    public function getFechAttribute(){
        $fech = Carbon::parse($this->last_login_at)->diffForHumans();
        return $fech;
    }


    public function roles(){
        return $this->belongsToMany('App\Role','role_user')->withTimestamps();
    }

    /**
    ** Check multiple roles
    ** @param array $roles
    **/

    public function authorizeRoles($roles){

        if ($this->hasAnyRole($roles)){
            return true;
        }
        return view('errors.404','Acción no encontrada',404);
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
        'identification', 'name', 'last_name', 'username','email', 'password', 'state', 'last_login_at'

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

    public function setStateAttribute($value){
        $state = ($value) ? 1 : 2;
        $this->attributes['state'] = $state;
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function isOnline(){
        return Cache::has('user-is-online-' . $this->id);
    }



}
