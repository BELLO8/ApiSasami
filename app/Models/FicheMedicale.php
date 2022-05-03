<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FicheMedicale extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id_personne_vulnerable',
        'poids',
        'taille',
        'probleme_medicale',
        'traitement',
        'groupe_sanguin',
        'contact_personne_proche'
    ];

    public function Personne_vulnerable()
	{
		return $this->belongsTo(PersonneVulnerable::class, 'id_personne_vulnerable');
	}
}
