<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'sucursal_id', // Agregar sucursal_id a los campos fillable
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getRoleName()
    {
        switch ($this->role) {
            case \App\Http\Middleware\RoleManager::ROLE_ADMIN:
                return 'admin';
            case \App\Http\Middleware\RoleManager::ROLE_GUARDIA:
                return 'guardia';
            case \App\Http\Middleware\RoleManager::ROLE_RECEPCIONISTA:
                return 'recepcionista';
            case \App\Http\Middleware\RoleManager::ROLE_ENCARGADO_SUCURSAL:
                return 'encargado_sucursal';
            case \App\Http\Middleware\RoleManager::ROLE_LOGISTICA:
                return 'logistica';
            case \App\Http\Middleware\RoleManager::ROLE_MONITORISTA:
                return 'monitorista';
            default:
                return null;
        }
    }

    // Relación con la sucursal
    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_id', 'id_sucursal');
    }
}
