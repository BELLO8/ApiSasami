<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dispositif extends Model
{
    protected $fillable =  [
        'id',
        'ref',
        'fiche',
        'numero',
        'date'
    ];
    use HasFactory;

    protected $table='dispositif';

    public $timestamps = false;
}
