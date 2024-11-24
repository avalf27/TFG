<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObrasArte extends Model
{
    use HasFactory;

    protected $table = 'obras_arte';

    protected $fillable = [
        'titulo',
        'descripcion',
        'año',
        'precio',
        'imagen',
        'estado',
        'id_artista',  // Relación con el artista
    ];

    // Relación con el artista (cada obra de arte pertenece a un artista)
    public function artista()
    {
        return $this->belongsTo(Artista::class, 'id_artista');
    }

    // Relación con exposiciones (muchas obras pueden pertenecer a muchas exposiciones)
    public function exposiciones()
    {
        return $this->belongsToMany(Exposicion::class, 'exposicion_obra', 'id_obra', 'id_exposicion');
    }

    public function usuariosFavoritos()
    {
        return $this->belongsToMany(User::class, 'favoritos_obras_arte', 'id_obra', 'id_usuario')->withTimestamps();
    }

}
