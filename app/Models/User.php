<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Los atributos que deben estar ocultos en la representación JSON del modelo.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relación muchos a muchos con la tabla roles.
     *
     * Un usuario puede tener varios roles.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Verifica si el usuario tiene un rol específico.
     *
     * @param string $role
     * @return bool
     */
    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists();
    }

    /**
     * Asigna un rol al usuario.
     *
     * @param string $role
     * @return void
     */
    public function assignRole($role)
    {
        $role = Role::where('name', $role)->first();
        if ($role) {
            $this->roles()->attach($role);
        }
    }

    /**
     * Elimina un rol del usuario.
     *
     * @param string $role
     * @return void
     */
    public function removeRole($role)
    {
        $role = Role::where('name', $role)->first();
        if ($role) {
            $this->roles()->detach($role);
        }
    }
}
