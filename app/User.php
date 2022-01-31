<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','last_name','email', 'password',
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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['full_name'];



    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     /**
     * Return the user's full name.
     *
     * @param boolean $byLastName - Last name first.
     * @return string
     */
    public function getFullNameAttribute($byLastName = false)
    {
        if ($byLastName) {
            return trim($this->last_name . ' ' . $this->name);
        }
        return trim($this->name . ' ' . $this->last_name);
    }

    /*
    |--------------------------------------------------------------------------
    | ACL
    |--------------------------------------------------------------------------
    */

    /**
     * Determine if the user may perform the given permission.
     *
     * @param  Permission $permission
     * @return boolean
     */
    public function hasPermission(Permission $permission)
    {
        return $this->hasRole($permission->roles);
    }

     /**
     * Determine if the user has the given role.
     *
     * @param  mixed $role
     * @return boolean
     */
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->role->key_name == $role;
        }

        if ($role instanceof Role) {
            return $this->role->is($role);
        }

        return $role->contains($this->role);
    }

   /**
     * Determine if logged user has "superadmin" role.
     *
     * @return boolean
     */
    public function isSuperAdmin() {
        return $this->hasRole('superadmin');
    }

    /**
     * Get the section that owns the role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

}
