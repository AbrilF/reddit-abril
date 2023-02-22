<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description'
    ];
    
    //Relaciones
    //Relación Communities 1:N Posts
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    //Relación Users N:M Communities
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
