<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'titulo',
        'extracto',
        'contenido',
        'cadicable',
        'comentable',
        'acceso'
    ];
    
    //Relaciones  Comments 1:N Posts
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //Relacion Posts 1:N Communities
    public function communities()
    {
        return $this->belongsTo(Community::class);
    }

    //Relación Users 1:N Posts
    public function users()
    {
        return $this->belongsTo(User::class);
    }

}
