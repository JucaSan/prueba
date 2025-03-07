<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
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
}
