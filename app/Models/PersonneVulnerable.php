<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PersonneVulnerable
 * 
 * @property int $id
 * @property string|null $nom
 * @property string|null $prenom
 * @property string|null $adresse
 * @property string|null $telephone
 * @property int|null $age
 * 
 * @property Collection|Assigner[] $assigners
 * @property Collection|Surveiller[] $surveillers
 *
 * @package App\Models
 */
class PersonneVulnerable extends Model
{
	protected $table = 'personneVulnerable';
	public $timestamps = false;

	protected $casts = [
		'age' => 'int'
	];

	protected $fillable = [
		'nom',
		'prenom',
		'adresse',
		'telephone',
		'age'
	];

	public function assigners()
	{
		return $this->hasMany(Assigner::class, 'id_personneV');
	}

	public function surveillers()
	{
		return $this->hasMany(Surveiller::class, 'personne_vulnerable');
	}
}
