<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'nombre',
    ];

    // Relación con usuarios (un rol tiene muchos usuarios)
    public function usuarios()
    {
        return $this->hasMany(Usuario::class);
    }
}
