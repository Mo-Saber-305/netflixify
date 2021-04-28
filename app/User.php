<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*--------------------------------------attributes -------------------------------------------*/

    public function getEmailAttribute($value)
    {
        return strtolower($value);
    }

    /*--------------------------------------attributes -------------------------------------------*/

    public function scopeWhereRole($query, $role_name)
    {
        return $query->whereHas('roles', function ($q) use ($role_name) {
            return $q->whereIn('name', (array)$role_name);
        });
    } /*end of scopeWhereRole*/

    public function scopeWhereRoleNot($query, $role_name)
    {
        return $query->whereHas('roles', function ($q) use ($role_name) {
            return $q->whereNotIn('name', (array)$role_name);
        });
    } /*end of scopeWhereRoleNot*/

    public function scopeWhenRole($query, $role_id)
    {
        return $query->when($role_id, function ($que) use ($role_id) {
            return $que->whereHas('roles', function ($q) use ($role_id) {
                $q->where('id', $role_id);
            });
        });
    } /*end of scopeWhenRole*/
}
