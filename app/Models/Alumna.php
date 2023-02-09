<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumna extends Model
{
    use HasFactory;
    protected $fillable = ['fechaNacimiento','dni','Apellidos','Nombres','direccion','celular','dniMadre','dniPadre','estadoAlumna'];
}
