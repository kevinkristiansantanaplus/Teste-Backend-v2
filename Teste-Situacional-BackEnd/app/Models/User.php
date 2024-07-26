<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    // Método usado pela lib, obtém o identificador JWT
    public function getJWTIdentifier()
    {

        return $this->getKey();

    }

    // Método usado pela lib, retorna uma matriz de informações personalizadas adicionadas ao JWT
    public function getJWTCustomClaims()
    {

        return [];

    }

}
