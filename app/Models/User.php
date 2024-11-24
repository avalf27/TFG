<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Role; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nombre',
        'apellidos',
        'fecha_nacimiento',
        'nie',
        'email',
        'password',
        'id_role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $table = 'usuarios';


    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role');
    }

    public function obrasFavoritas()
        {
            return $this->belongsToMany(ObrasArte::class, 'favoritos_obras_arte', 'id_usuario', 'id_obra')->withTimestamps();
        }

    public function exposicionesFavoritas()
        {
            return $this->belongsToMany(Exposicion::class, 'favoritos_exposiciones', 'id_usuario', 'id_exposicion')->withTimestamps();
        }
        
        public function artistasFavoritos()
        {
            return $this->belongsToMany(Artista::class, 'favoritos_artistas', 'id_usuario', 'id_artista')->withTimestamps();
        }


     // Método personalizado para obtener todos los administradores
     public static function obtenerAdministradores()
     {
         return self::whereHas('role', function ($query) {
             $query->where('nombre', 'Administrador');
         })->get();
     }
}
