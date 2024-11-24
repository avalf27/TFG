<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exposicion extends Model
{
    use HasFactory;

    protected $table = 'exposiciones';

    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha_inicio',
        'fecha_finalizacion',
    ];

    // Relación con obras de arte (muchas obras pueden estar en muchas exposiciones)
    public function obras()
    {
        return $this->belongsToMany(ObrasArte::class, 'exposicion_obra', 'id_exposicion', 'id_obra');
    }

    // Relación con artistas (muchos artistas pueden estar en muchas exposiciones)
    public function artistas()
    {
        return $this->belongsToMany(Artista::class, 'exposicion_artista', 'id_exposicion', 'id_artista');
    }

    public function usuariosFavoritos()
    {
        return $this->belongsToMany(User::class, 'favoritos_exposiciones', 'id_exposicion', 'id_usuario')->withTimestamps();
    }

}
