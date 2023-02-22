<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'coment'
    ];
    
    //Relaciones
    //Relacion Posts 1:N Comments
    public function posts()
    {
        return $this->belongsTo(Post::class);
    }

    //Relacion Users 1:N Coments
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
