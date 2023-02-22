<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    protected function name(): Attribute{
        //Mutador y Accesor        
        return new Attribute(
            //Accesor: devolver las primeras letras del name en mayuscula
            get: fn($value) => ucwords($value),
            //Mutador: retornar el campo name en minuscula a la base de datos
            set: fn($value) => strtolower($value)
        );
            
    }
    
    //Relaciones
    //Ralacion Users N:M Communities
    public function communities()
    {
        return $this->belongsToMany(Community::class);
    }

    //Relacion Users 1:N Post
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    //Relacion Users 1:N Comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
