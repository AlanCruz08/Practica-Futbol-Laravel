<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class equipo extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'nombre',
        'dir_deportivo',
      //  'estadio_id',
    ];

    protected $hidden = [
        'estadio_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
