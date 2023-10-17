<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Comentario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    // Relacion donde un post pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }

    // Mostrar los comentarios
    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
    // Mostrar los likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    // Evitar duplicados en likes
    public function checkLike(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }
}
