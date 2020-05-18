<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $fillable = [
        'id',
        'titulo',
        'nota'
    ];

    public $timestamps=false;
    public $table = 'notas';
    public $primaryKey = 'id';
}
