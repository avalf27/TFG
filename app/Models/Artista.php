<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Para autenticación
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Artista extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nombre',
        'apellidos',
        'fecha_nacimiento',
        'nie',
        'biografia',
        'nacionalidad',
        'experiencia',
        'id_role',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role');
    }
    // Relación con obras de arte (un artista tiene muchas obras)
    public function obras()
    {
        return $this->hasMany(ObrasArte::class, 'id_artista');
    }

    public function exposiciones()
    {
        return $this->belongsToMany(Exposicion::class, 'exposicion_artista', 'id_artista', 'id_exposicion');
    }

    // Relación con los usuarios que tienen este artista como favorito
    public function usuariosFavoritos()
    {
        return $this->belongsToMany(User::class, 'favoritos_artistas', 'id_artista', 'id_usuario')->withTimestamps();
    }

        // En el modelo Artista.php
    public function exposicionesFavoritas()
    {
        return $this->belongsToMany(Exposicion::class, 'favoritos_exposiciones', 'id_artista', 'id_exposicion');
    }

}
